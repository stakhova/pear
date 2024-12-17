<?php

class Stripe_Integration
{
    public static function init()
    {
        add_action('wp_ajax_payment_callback', [__CLASS__, 'payment_callback']);
        add_action('wp_ajax_nopriv_payment_callback', [__CLASS__, 'payment_callback']);
    }

    public static function create_user($user_email, $name, $phome, $order_id, $order_type)
    {
        if (!empty($user_email)) {
            $customer = \Stripe\Customer::create([
                'email' => $user_email,
                'name' => $name,
                'metadata' => [
                    'order_id' => $order_id,
                    'order_type' => $order_type
                ],
            ]);

            return $customer->id;
        }
    }

    public static function create_payment_link($order_id, $price, $order_type)
    {
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Order - ' . $order_id,
                        ],
                        'unit_amount' => $price * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => get_the_permalink(Page_Successful_Payment::get_ID()),
            'cancel_url' => get_the_permalink(Page_Failed_Payment::get_ID()),
            'metadata' => [
                'order_id' => $order_id,
                'order_type' => $order_type,
            ],
        ]);

        return $session->url;
    }

    public static function payment_callback()
    {
        $endpoint_secret = 'whsec_PUxAB4694qaPACZHBLWl6CBnTuiyR6qr';
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
                $order_id = $checkout->course_id;
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
                    wp_mail(get_field('managers', Page_Option::get_ID())['emails'], 'New course request #' . $order_id, $massages, $headers);
                }

                if ($order_type == 'seminar') {
                    $seminar_id = get_field('seminar_id', $order_id);
                    $users_count = get_field('main_options', $seminar_id)['number_of_seats'];
                    $users_count = $users_count - get_field('count', $order_id);
                    update_field('main_options_number_of_seats', $users_count, $seminar_id);

                    update_field('status', 'paid', $order_id);

                    $name = get_field('name', $order_id);
                    $company = get_field('company', $order_id);
                    $address = get_field('address', $order_id);
                    $state = get_field('state', $order_id);
                    $post_code = get_field('post_code', $order_id);
                    $phone = get_field('phone', $order_id);
                    $email = get_field('email', $order_id);

                    $headers = 'content-type: text/html';
                    $massages =
                        'Seminar: ' . get_the_title($seminar_id) . '<br>' .
                        'Company: ' . $company . '<br>' .
                        'Address: ' . $address . '<br>' .
                        'Name: ' . $name . '<br>' .
                        'State: ' . $state . '<br>' .
                        'Post code: ' . $post_code . '<br>' .
                        'Post code: ' . $post_code . '<br>' .
                        'Phone: ' . $phone . '<br>' .
                        'Email: ' . $email . '<br>';
                    wp_mail(get_field('managers', Page_Option::get_ID())['emails'], 'New seminar request #' . $order_id, $massages, $headers);
                }
        }
    }
}
