<?php

class Stripe_Integration
{
    public static function init()
    {
        add_action('wp_ajax_payment_callback', [__CLASS__, 'payment_callback']);
        add_action('wp_ajax_nopriv_payment_callback', [__CLASS__, 'payment_callback']);
    }

    public static function create_user($user_email, $name)
    {


        if (!empty($user_email)) {
            $customer = \Stripe\Customer::create([
                'email' => $user_email,
                'name' => $name,
            ]);

            return $customer->id;
        }
    }

    public static function create_payment_link($order_id, $price, $order_type, $page_id)
    {
        $email = get_field('email', $order_id);
        $name = get_field('name', $order_id);
        $customer_id = self::create_user($email, $name);

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Order - ' . get_the_title($order_id),
                        ],
                        'unit_amount' => $price * 1.19 * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'customer' => $customer_id,
            'payment_intent_data' => [
                'receipt_email' => $email,
            ],
            'success_url' => get_the_permalink(Page_Successful_Payment::get_ID()),
            'cancel_url' => get_the_permalink(Page_Failed_Payment::get_ID()) . '?link=' . $page_id,
            'metadata' => [
                'order_id' => $order_id,
                'order_type' => $order_type,
            ],
        ]);

        return $session->url;
    }

    public static function payment_callback()
    {
        $endpoint_secret = 'whsec_MINnUqDI9tMmaR7IdAnbLSONk1odUGIw';
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            http_response_code(400);
            exit();
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                $checkout = $event->data->object->metadata;
                $order_id = $checkout->order_id;
                $order_type = $checkout->order_type;

                if ($order_type == 'course') {
                    update_field('status', 'paid', $order_id);

                    $name = get_field('name', $order_id);
                    $company = get_field('company', $order_id);
                    $address = get_field('address', $order_id);
                    $state = get_field('state', $order_id);
                    $post_code = get_field('post_code', $order_id);
                    $phone = get_field('phone', $order_id);
                    $email = get_field('email', $order_id);
                    $course_name = get_field('course_name', $order_id);

                    $user_data = [
                        'firstName' => $name,
                        'email' => $email,
                        'company' => $company,
                    ];

                    Reatech_Integration::create_user($user_data);

                    $headers = 'content-type: text/html';
                    $massages =
                        'Course name: ' . $course_name . '<br>' .
                        'Company: ' . $company . '<br>' .
                        'Address: ' . $address . '<br>' .
                        'Name: ' . $name . '<br>' .
                        'State: ' . $state . '<br>' .
                        'Post code: ' . $post_code . '<br>' .
                        'Post code: ' . $post_code . '<br>' .
                        'Phone: ' . $phone . '<br>' .
                        'Email: ' . $email . '<br>';
                    mail(get_field('managers', Page_Option::get_ID())['emails'], 'New course request #' . $order_id, $massages, $headers);
                }

                if ($order_type == 'seminar') {
                    $seminar_id = get_field('seminar_id', $order_id);
                    $users_count = get_field('main_options', $seminar_id)['number_of_seats'];
                    $new_users_count = $users_count - get_field('count', $order_id);
                    $dates = get_field('main_options', $seminar_id)['dates'];

                    update_field('main_options_number_of_seats', $new_users_count, $seminar_id);

                    update_field('status', 'paid', $order_id);

                    $company = get_field('company', $order_id);
                    $address = get_field('address', $order_id);
                    $state = get_field('state', $order_id);
                    $post_code = get_field('post_code', $order_id);
                    $phone = get_field('phone', $order_id);
                    $names = get_field('names', $order_id);
                    $emails = get_field('emails', $order_id);

                    $headers = 'content-type: text/html';
                    $massages =
                        'Seminar: ' . get_the_title($seminar_id) . '<br>' .
                        'Company: ' . $company . '<br>' .
                        'Address: ' . $address . '<br>' .
                        'Names: ' . $names . '<br>' .
                        'State: ' . $state . '<br>' .
                        'Post code: ' . $post_code . '<br>' .
                        'Post code: ' . $post_code . '<br>' .
                        'Phone: ' . $phone . '<br>' .
                        'Emails: ' . $emails . '<br>';
                    mail(get_field('managers', Page_Option::get_ID())['emails'], 'New seminar request #' . $order_id, $massages, $headers);

                    self::send_seminar_payment_email($email, $name, get_the_title($seminar_id), $dates);
                }
        }
    }


    public static function send_seminar_payment_email($user_email, $user_name, $seminar_title, $seminar_dates)
    {
        $subject = "Erfolgreiche Zahlung für Ihr Seminar";

        $formatted_dates = [];
        foreach ($seminar_dates as $date) {
            $date_parts = explode('/', $date['date']); // Розділяємо день, місяць, рік
            if (count($date_parts) === 3) {
                $formatted_date = DateTime::createFromFormat('d/m/Y H:i:s', $date['date'] . ' 10:00:00', new DateTimeZone('UTC'));
                if ($formatted_date) {
                    $formatted_dates[] = $formatted_date->format('Ymd\THis\Z');
                }
            }
        }

        if (count($formatted_dates) > 1) {
            $google_calendar_url = "https://www.google.com/calendar/render?action=TEMPLATE" .
                "&text=" . urlencode($seminar_title) .
                "&details=Weitere Informationen zum Seminar finden Sie auf unserer Website.";
            foreach ($formatted_dates as $formatted_date) {
                $google_calendar_url .= "&dates=" . $formatted_date . "/" . $formatted_date;
            }
        } else {
            $google_calendar_url = "https://www.google.com/calendar/render?action=TEMPLATE" .
                "&text=" . urlencode($seminar_title) .
                "&dates=" . $formatted_dates[0] . "/" . $formatted_dates[0] .
                "&details=Weitere Informationen zum Seminar finden Sie auf unserer Website.";
        }

        $message = "<p>Hallo " . esc_html($user_name) . ",</p>";
        $message .= "<p>Ihre Zahlung für das Seminar <strong>" . esc_html($seminar_title) . "</strong> war erfolgreich.</p>";
        $message .= "<p>Termine:</p><ul>";
        foreach ($seminar_dates as $date) {
            $message .= "<li>" . esc_html($date['date']) . "</li>";
        }
        $message .= "</ul>";
        $message .= "<p>Wir freuen uns, Sie dort zu sehen!</p>";
        $message .= "<p><a href='" . esc_url($google_calendar_url) . "' target='_blank' style='display:inline-block;padding:10px 20px;background:#4285F4;color:#fff;text-decoration:none;border-radius:5px;'>Zum Google Kalender hinzufügen</a></p>";
        $message .= "<p>Mit freundlichen Grüßen,<br>Ihr Seminar-Team</p>";

        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: Ihr Seminar-Team <no-reply@yourwebsite.com>'
        ];

        wp_mail($user_email, $subject, $message, $headers);
    }
}
