<?php

class Type_Campus_Request
{

    public static function init()
    {
        add_action('init', [__CLASS__, 'registerPostType']);
        add_action('acf/init', [__CLASS__, 'acf_add_local_field_group']);

        add_action('wp_ajax_campus_request', [__CLASS__, 'campus_request']);
        add_action('wp_ajax_nopriv_campus_request', [__CLASS__, 'campus_request']);
    }

    public static function campus_request()
    {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $post_id = wp_insert_post(array(
            'post_type' => 'campus_request',
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
        mail(get_field('managers', Page_Option::get_ID())['emails'], 'New campus request #' . $post_id, $massages, $headers);
    }

    public static function registerPostType()
    {

        register_post_type('campus_request', [
            'label'  => 'Campus request',
            'labels' => [
                'name'               => 'Campus request',
                'singular_name'      => 'Campus request',
                'add_new'            => 'Add Campus request',
                'add_new_item'       => 'Adding Campus request',
                'edit_item'          => 'Edit Campus request',
                'new_item'           => 'New Campus request',
                'view_item'          => 'See Campus request',
                'search_items'       => 'Search Campus request',
                'not_found'          => 'Not Found',
                'parent_item_colon'  => '',
                'menu_name'          => 'Campus request',
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
                'key' => 'group_674e41b239ba1',
                'title' => 'Campus request',
                'fields' => array(
                    array(
                        'key' => 'field_674e41b2cd7fd',
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
                        'key' => 'field_674e41bfcd7fe',
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
                        'key' => 'field_674e41c3cd7ff',
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
                        'key' => 'field_674e41c7cd800',
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
                            'value' => 'campus_request',
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
