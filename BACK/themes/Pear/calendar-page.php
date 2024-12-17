<?php /* Template Name: Calendar page */ ?>
<?php get_header(); ?>

<?php 
$args = $args = array(
    'post_type' => 'seminar',
    'posts_per_page' => 99999999,
);
$query = new WP_Query($args);
$seminars = [];
foreach ($query->posts as $post) {
   
    if (has_term('exklusiv','seminar_type',$post->ID)) {
        $color = 'yelow';
    } else {
        if (get_field('main_options',$post->ID)['shortly']) {
            $color = 'green';
        } else {
            $color = 'gray';
        }
    }

    $seminars[] = [
        'url' => get_the_permalink($post->ID),
        'dates' => get_field('main_options',$post->ID)['dates'],
        'title' => get_the_title($post->ID),
        'plave' => get_field('main_options',$post->ID)['venue'],
        'color' => $color,
    ];
}
?>
<script>
    const seminars = '<?php echo json_encode($seminars); ?>';
</script>
<?php wp_reset_postdata(); ?>
<?php (new Calendar_Page_Banner_Section())->render()?>
<?php (new Calendar_Page_Form_Section())->render()?>
<?php get_footer(); ?>