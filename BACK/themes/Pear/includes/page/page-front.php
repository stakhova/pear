<?php

class Page_Front
{

    public static function init()
    {
        add_action('acf/init', [__CLASS__, 'acf_add_local_field_group']);
    }

    public static function acf_add_local_field_group()
    {
        if (function_exists('acf_add_local_field_group')):

            

        endif;
    }
}
