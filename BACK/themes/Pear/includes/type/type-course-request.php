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
        $company = $_POST['company'];
        $address = $_POST['address'];
        $state = $_POST['state'];
        $post_code = $_POST['post_code'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $course_name = $_POST['course_name'];
        $course_id = $_POST['course_id'];

        $post_id = wp_insert_post(array(
            'post_type' => 'course_request',
            'post_status' => 'publish',
            'post_title' => $name . ' - ' . $phone,
        ));

        update_field('name', $name, $post_id);
        update_field('company', $company, $post_id);
        update_field('address', $address, $post_id);
        update_field('state', $state, $post_id);
        update_field('post_code', $post_code, $post_id);
        update_field('phone', $phone, $post_id);
        update_field('email', $email, $post_id);
        update_field('course_name', $course_name, $post_id);
        update_field('status', 'new', $post_id);

        $price = get_field('main_options', $course_id)['price'];
        $redirect_url = Stripe_Integration::create_payment_link($post_id, $price, 'course', $course_id);
        wp_send_json_success(['redirect_url' => $redirect_url], 200);
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

            acf_add_local_field_group(array(
                'key' => 'group_67596008aafe8',
                'title' => 'Course request',
                'fields' => array(
                    array(
                        'key' => 'field_6759600995ef9',
                        'label' => 'Status',
                        'name' => 'status',
                        'aria-label' => '',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'new' => 'New',
                            'paid' => 'Paid',
                        ),
                        'default_value' => false,
                        'return_format' => 'value',
                        'multiple' => 0,
                        'allow_null' => 0,
                        'allow_in_bindings' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'placeholder' => '',
                    ),
                    array(
                        'key' => 'field_6759608595f01',
                        'label' => 'Course name',
                        'name' => 'course_name',
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
                        'key' => 'field_6759603d95efa',
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
                        'key' => 'field_6759604695efb',
                        'label' => 'Company',
                        'name' => 'company',
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
                        'key' => 'field_6759605295efc',
                        'label' => 'Address',
                        'name' => 'address',
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
                        'key' => 'field_6759605b95efd',
                        'label' => 'State',
                        'name' => 'state',
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
                        'key' => 'field_6759606295efe',
                        'label' => 'Post code',
                        'name' => 'post_code',
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
                        'key' => 'field_6759607595eff',
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
                        'key' => 'field_6759607d95f00',
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
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'course_request',
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
