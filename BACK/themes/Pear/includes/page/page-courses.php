<?php

class Page_Courses
{

    public static function init()
    {
        add_action('acf/init', [__CLASS__, 'acf_add_local_field_group']);
    }

    public static function get_ID()
    {
        $page = get_pages([
            'meta_key' => '_wp_page_template',
            'meta_value' => 'archive-course.php',
        ]);

        return ($page && 'publish' === $page[0]->post_status) ? $page[0]->ID : false;
    }

    public static function get_url()
    {
        $page = get_pages([
            'meta_key' => '_wp_page_template',
            'meta_value' => 'archive-course.php',
        ]);

        return ($page && 'publish' === $page[0]->post_status) ? get_the_permalink($page[0]->ID) : false;
    }

    public static function acf_add_local_field_group()
    {
        if (function_exists('acf_add_local_field_group')):

            acf_add_local_field_group(array(
                'key' => 'group_674ed467e387b',
                'title' => 'Courses page',
                'fields' => array(
                    array(
                        'key' => 'field_674ed4680b1a4',
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
                        'key' => 'field_674ed4850b1a5',
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
                                'key' => 'field_674ed48a0b1a6',
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
                                'key' => 'field_674ed48e0b1a7',
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
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_674ed4960b1a8',
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
                        'key' => 'field_674ed49f0b1a9',
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
                                'key' => 'field_674ed4a40b1aa',
                                'label' => 'Numberpost',
                                'name' => 'numberpost',
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
                            'value' => 'archive-course.php',
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
