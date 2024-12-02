<?php

class Page_Failed_Payment
{

    public static function init()
    {
        add_action('acf/init', [__CLASS__, 'acf_add_local_field_group']);
    }

    public static function get_ID()
    {
        $page = get_pages([
            'meta_key' => '_wp_page_template',
            'meta_value' => 'failed-payment-page.php',
        ]);

        return ($page && 'publish' === $page[0]->post_status) ? $page[0]->ID : false;
    }

    public static function acf_add_local_field_group()
    {
        if (function_exists('acf_add_local_field_group')):

            

        endif;
    }
}
