<?php

class Type_campus_request
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
        wp_mail(get_option('admin_email'), 'New campus request #' . $post_id, $massages, $headers);


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
                'key' => 'group_674e3a61c4a30',
                'title' => 'Campus page',
                'fields' => array(
                    array(
                        'key' => 'field_674e3a62ae80a',
                        'label' => 'Section "Banner"',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                        'selected' => 0,
                    ),
                    array(
                        'key' => 'field_674e3a74ae80b',
                        'label' => '',
                        'name' => 'section_banner',
                        'aria-label' => '',
                        'type' => 'group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_674e3a7aae80c',
                                'label' => 'Title',
                                'name' => 'title',
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
                                'key' => 'field_674e3a7fae80d',
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
                            array(
                                'key' => 'field_674e3a88ae80e',
                                'label' => 'Button',
                                'name' => 'button',
                                'aria-label' => '',
                                'type' => 'link',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'return_format' => 'array',
                                'allow_in_bindings' => 0,
                            ),
                            array(
                                'key' => 'field_674e3a90ae80f',
                                'label' => 'Image',
                                'name' => 'image',
                                'aria-label' => '',
                                'type' => 'image',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'return_format' => 'url',
                                'library' => 'all',
                                'min_width' => '',
                                'min_height' => '',
                                'min_size' => '',
                                'max_width' => '',
                                'max_height' => '',
                                'max_size' => '',
                                'mime_types' => '',
                                'allow_in_bindings' => 0,
                                'preview_size' => 'medium',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_674e3a9bae810',
                        'label' => 'Section "Content"',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                        'selected' => 0,
                    ),
                    array(
                        'key' => 'field_674e3aa4ae811',
                        'label' => '',
                        'name' => 'section_content',
                        'aria-label' => '',
                        'type' => 'group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_674e3aabae812',
                                'label' => 'Items',
                                'name' => 'items',
                                'aria-label' => '',
                                'type' => 'repeater',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'layout' => 'table',
                                'pagination' => 0,
                                'min' => 0,
                                'max' => 0,
                                'collapsed' => '',
                                'button_label' => 'Add Row',
                                'rows_per_page' => 20,
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_674e3ab0ae813',
                                        'label' => 'Icon',
                                        'name' => 'icon',
                                        'aria-label' => '',
                                        'type' => 'image',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => array(
                                            'width' => '',
                                            'class' => '',
                                            'id' => '',
                                        ),
                                        'return_format' => 'url',
                                        'library' => 'all',
                                        'min_width' => '',
                                        'min_height' => '',
                                        'min_size' => '',
                                        'max_width' => '',
                                        'max_height' => '',
                                        'max_size' => '',
                                        'mime_types' => '',
                                        'allow_in_bindings' => 0,
                                        'preview_size' => 'medium',
                                        'parent_repeater' => 'field_674e3aabae812',
                                    ),
                                    array(
                                        'key' => 'field_674e3ab8ae814',
                                        'label' => 'Title',
                                        'name' => 'title',
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
                                        'parent_repeater' => 'field_674e3aabae812',
                                    ),
                                    array(
                                        'key' => 'field_674e3abcae815',
                                        'label' => 'Text',
                                        'name' => 'text',
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
                                        'parent_repeater' => 'field_674e3aabae812',
                                    ),
                                ),
                            ),
                            array(
                                'key' => 'field_674e3ac7ae816',
                                'label' => 'Form title',
                                'name' => 'form_title',
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
                                'key' => 'field_674e3acbae817',
                                'label' => 'Form text',
                                'name' => 'form_text',
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
                                'key' => 'field_674e3ad2ae818',
                                'label' => 'Form email',
                                'name' => 'form_email',
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
                                'key' => 'field_674e3adbae819',
                                'label' => 'Person image',
                                'name' => 'person_image',
                                'aria-label' => '',
                                'type' => 'image',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'return_format' => 'url',
                                'library' => 'all',
                                'min_width' => '',
                                'min_height' => '',
                                'min_size' => '',
                                'max_width' => '',
                                'max_height' => '',
                                'max_size' => '',
                                'mime_types' => '',
                                'allow_in_bindings' => 0,
                                'preview_size' => 'medium',
                            ),
                            array(
                                'key' => 'field_674e3ae4ae81a',
                                'label' => 'Person name',
                                'name' => 'person_name',
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
                                'key' => 'field_674e3aecae81b',
                                'label' => 'Person position',
                                'name' => 'person_position',
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
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'page_template',
                            'operator' => '==',
                            'value' => 'campus-page.php',
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
