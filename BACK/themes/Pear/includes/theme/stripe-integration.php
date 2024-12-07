<?php

class Stripe_Integration
{
    public static function init()
    {
        add_action('wp_ajax_payment_callback', [__CLASS__, 'payment_callback']);
        add_action('wp_ajax_nopriv_payment_callback', [__CLASS__, 'payment_callback']);
    }

    public static function create_user($user_email, $name, $phome, $order_id)
    {
        if (!empty($user_email)) {
            $customer = \Stripe\Customer::create([
                'email' => $user_email,
                'name' => $name,
                'metadata' => [
                    'order_id' => $order_id,
                ],
            ]);

            return $customer->id;
        }
    }

    public static function create_payment_link($customer_id, $order_id, $price, $success_url, $cancel_url)
    {
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'customer' => $customer_id,
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
            'success_url' => $success_url,
            'cancel_url' => $cancel_url,
            'metadata' => [
                'order_id' => $order_id,
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
               
        }
    }
}
