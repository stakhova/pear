<?php

class Type_Course
{

    public static function init()
    {
        add_action('init', [__CLASS__, 'registerPostType']);
        add_action('acf/init', [__CLASS__, 'acf_add_local_field_group']);
    }
    public static function registerPostType()
    {

        register_post_type('course', [
            'label'  => 'Course ',
            'labels' => [
                'name'               => 'Course',
                'singular_name'      => 'Course',
                'add_new'            => 'Add Course',
                'add_new_item'       => 'Adding Course',
                'edit_item'          => 'Edit Course',
                'new_item'           => 'New Course',
                'view_item'          => 'See Course',
                'search_items'       => 'Search Course',
                'not_found'          => 'Not Found',
                'parent_item_colon'  => '',
                'menu_name'          => 'Course',
            ],
            'public'              => true,
            'supports'            => ['title','thumbnail'],
            'has_archive'         => true,
        ]);

        register_taxonomy(
            'course_type',
            'course',
            array(
                'label' => __('Type'),
                'rewrite' => array('slug' => 'course-type'),
                'hierarchical' => true,
            )
        );

    }

    public static function acf_add_local_field_group()
    {

        if (function_exists('acf_add_local_field_group')):

            

        endif;
    }
}
