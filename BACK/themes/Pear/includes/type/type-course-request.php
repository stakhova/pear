<?php

class Type_Course_Request
{

    public static function init()
    {
        add_action('init', [__CLASS__, 'registerPostType']);
        add_action('acf/init', [__CLASS__, 'acf_add_local_field_group']);

        add_action('wp_ajax_course_request', [__CLASS__, 'course_request']);
        add_action('wp_ajax_nopriv_course_request', [__CLASS__, 'course_request']);

    }

    public static function course_request()
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
        wp_mail(get_option('admin_email'), 'New campus request #' . $post_id, $massages, $headers);


    }

    public static function registerPostType()
    {

        register_post_type('course_request', [
            'label'  => 'Course request',
            'labels' => [
                'name'               => 'Course request',
                'singular_name'      => 'Course request',
                'add_new'            => 'Add Course request',
                'add_new_item'       => 'Adding Course request',
                'edit_item'          => 'Edit Course request',
                'new_item'           => 'New Course request',
                'view_item'          => 'See Course request',
                'search_items'       => 'Search Course request',
                'not_found'          => 'Not Found',
                'parent_item_colon'  => '',
                'menu_name'          => 'Course request',
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

            

        endif;
    }
}
