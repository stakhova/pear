<?php

class Type_Seminar_Request
{

    public static function init()
    {
        add_action('init', [__CLASS__, 'registerPostType']);
        add_action('acf/init', [__CLASS__, 'acf_add_local_field_group']);

        add_action('wp_ajax_seminar_request', [__CLASS__, 'seminar_request']);
        add_action('wp_ajax_nopriv_seminar_request', [__CLASS__, 'seminar_request']);
    }

    public static function seminar_request()
    {
        $company = $_POST['company'];
        $address = $_POST['address'];
        $state = $_POST['state'];
        $post_code = $_POST['post_code'];
        $phone = $_POST['phone'];
        $seminar_id = $_POST['seminar_id'];
        $count = $_POST['count'];

        $emails = $_POST['email'];
        $names = $_POST['name'];


        $post_id = wp_insert_post(array(
            'post_type' => 'seminar_request',
            'post_status' => 'publish',
            'post_title' => $names[0] . ' - ' . $phone,
        ));
        update_field('emails', implode(', ', $emails), $post_id);
        update_field('names', implode(', ', $names), $post_id);

        update_field('company', $company, $post_id);
        update_field('address', $address, $post_id);
        update_field('state', $state, $post_id);
        update_field('post_code', $post_code, $post_id);
        update_field('phone', $phone, $post_id);
        update_field('status', 'new', $post_id);
        update_field('count', $count, $post_id);
        update_field('seminar_id', $seminar_id, $post_id);
        update_field('seminar_name', get_the_title($seminar_id), $post_id);

        $price = get_field('main_options', $seminar_id)['price'] * $count;
        $redirect_url = Stripe_Integration::create_payment_link($post_id, $price, 'seminar', $seminar_id);
        wp_send_json_success(['redirect_url' => $redirect_url], 200);
    }

    public static function registerPostType()
    {

        register_post_type('seminar_request', [
            'label'  => 'Seminar request',
            'labels' => [
                'name'               => 'Seminar request',
                'singular_name'      => 'Seminar request',
                'add_new'            => 'Add Seminar request',
                'add_new_item'       => 'Adding Seminar request',
                'edit_item'          => 'Edit Seminar request',
                'new_item'           => 'New Seminar request',
                'view_item'          => 'See Seminar request',
                'search_items'       => 'Search Seminar request',
                'not_found'          => 'Not Found',
                'parent_item_colon'  => '',
                'menu_name'          => 'Seminar request',
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
                'key' => 'group_67596asfasf008aafe8',
                'title' => 'Seminar request',
                'fields' => array(
                    array(
                        'key' => 'field_67596009asfa95ef9',
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
                        'key' => 'field_675960asasfassafsafffasf3d95efa',
                        'label' => 'Seminar id',
                        'name' => 'seminar_id',
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
                        'key' => 'field_675960asasafawfsfassafsafffasf3d95efa',
                        'label' => 'Seminar name',
                        'name' => 'seminar_name',
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
                        'key' => 'field_675960asasfasffasf3d95efa',
                        'label' => 'Tiket count',
                        'name' => 'count',
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
                        'key' => 'field_675960asfasf3d95efa',
                        'label' => 'Names',
                        'name' => 'names',
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
                        'key' => 'field_675960safasf4695efb',
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
                        'key' => 'field_6759asfasf605295efc',
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
                        'key' => 'field_67asfasf59605b95efd',
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
                        'key' => 'field_675asfasf9606295efe',
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
                        'key' => 'field_6759asfsaf607595eff',
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
                        'key' => 'field_67asfsaf59607d95f00',
                        'label' => 'Emails',
                        'name' => 'emails',
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
                            'value' => 'seminar_request',
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
