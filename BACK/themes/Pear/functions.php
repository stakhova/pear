<?php 
define( 'TEMPLATE_PATH', get_template_directory_uri() );

add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails');
});

require_once __DIR__ .'/includes/theme/autoloader.php';
Theme_AutoLoader::init();

require_once(get_template_directory() . '/vendor/autoload.php');
\Stripe\Stripe::setApiKey(get_field('stripe', Page_Option::get_ID())['api_key']);

function my_acf_google_map_api( $api ){
    
    $api['key'] = 'AIzaSyDgGhu7gVtSqKxCC9tSywaqlPIpufe0CHs';
    
    return $api;
    
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');