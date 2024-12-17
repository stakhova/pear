<?php

class Type_Calendar_Request
{

    public static function init()
    {
        add_action('init', [__CLASS__, 'registerPostType']);
        add_action('acf/init', [__CLASS__, 'acf_add_local_field_group']);

        add_action('wp_ajax_calendar_request', [__CLASS__, 'calendar_request']);
        add_action('wp_ajax_nopriv_calendar_request', [__CLASS__, 'calendar_request']);
    }

    public static function calendar_request()
    {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $post_id = wp_insert_post(array(
            'post_type' => 'calendar_request',
            'post_status' => 'publish',
            'post_title' => $name . ' - ' . $phone,
        ));

        update_field('name', $name, $post_id);
        update_field('phone', $phone, $post_id);
        update_field('email', $email, $post_id);
        update_field('text', $message, $post_id);

        $headers = 'content-type: text/html';
        $massages =
            'Name: ' . $name . '<br>' .
            'Phone: ' . $phone . '<br>' .
            'Email: ' . $email . '<br>' .
            'Message: ' . $message . '<br>';
        wp_mail(get_field('managers', Page_Option::get_ID())['emails'], 'New calendar request #' . $post_id, $massages, $headers);
    }

    public static function registerPostType()
    {

        register_post_type('calendar_request', [
            'label'  => 'Calendar request',
            'labels' => [
                'name'               => 'Calendar request',
                'singular_name'      => 'Calendar request',
                'add_new'            => 'Add Calendar request',
                'add_new_item'       => 'Adding Calendar request',
                'edit_item'          => 'Edit Calendar request',
                'new_item'           => 'New Calendar request',
                'view_item'          => 'See Calendar request',
                'search_items'       => 'Search Calendar request',
                'not_found'          => 'Not Found',
                'parent_item_colon'  => '',
                'menu_name'          => 'Calendar request',
            ],
            'menu_icon'           => 'dashicons-email',
            'public'              => true,
            'supports'            => ['title'],
            'has_archive'         => true,
        ]);
    }

    public static function acf_add_local_field_group()
    {

        if (function_exists('acf_add_local_field_group')):

            acf_add_local_field_group(array(
                'key' => 'group_674e41asdasdb23asfasfasfasfasf9ba1',
                'title' => 'Campus request',
                'fields' => array(
                    array(
                        'key' => 'field_674e4asdasasfasfafasfsd121b2cd7fd',
                        'label' => 'Name',
                        'name' => 'name',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'maxlength' => '',
                        'allow_in_bindings' => 0,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_674e421asfasfsafasfs21s1bfcd7fe',
                        'label' => 'Phone',
                        'name' => 'phone',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'maxlength' => '',
                        'allow_in_bindings' => 0,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_674e12s21sasfsafasfasf41c3cd7ff',
                        'label' => 'Email',
                        'name' => 'email',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'maxlength' => '',
                        'allow_in_bindings' => 0,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_67412s2asfasfsafasf1se41c7cd800',
                        'label' => 'Text',
                        'name' => 'text',
                        'aria-label' => '',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'maxlength' => '',
                        'allow_in_bindings' => 0,
                        'rows' => '',
                        'placeholder' => '',
                        'new_lines' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'Calendar',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
                'show_in_rest' => 0,
            ));

        endif;
    }
}
