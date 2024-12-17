<?php

class Type_Seminar
{

    public static function init()
    {
        add_action('init', [__CLASS__, 'registerPostType']);
        add_action('acf/init', [__CLASS__, 'acf_add_local_field_group']);
    }
    public static function registerPostType()
    {

        register_post_type('seminar', [
            'label'  => 'Seminar ',
            'labels' => [
                'name'               => 'Seminar',
                'singular_name'      => 'Seminar',
                'add_new'            => 'Add Seminar',
                'add_new_item'       => 'Adding Seminar',
                'edit_item'          => 'Edit Seminar',
                'new_item'           => 'New Seminar',
                'view_item'          => 'See Seminar',
                'search_items'       => 'Search Seminar',
                'not_found'          => 'Not Found',
                'parent_item_colon'  => '',
                'menu_name'          => 'Seminar',
            ],
            'public'              => true,
            'supports'            => ['title', 'thumbnail'],
            'has_archive'         => true,
        ]);

        register_taxonomy(
            'seminar_theme',
            'seminar',
            array(
                'label' => __('Theme'),
                'rewrite' => array('slug' => 'seminar-theme'),
                'hierarchical' => true,
            )
        );

        register_taxonomy(
            'seminar_type',
            'seminar',
            array(
                'label' => __('Type'),
                'rewrite' => array('slug' => 'seminar-type'),
                'hierarchical' => true,
            )
        );

        register_taxonomy(
            'seminar_conducting_method',
            'seminar',
            array(
                'label' => __('Method of conducting'),
                'rewrite' => array('slug' => 'seminar-conducting-method'),
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
