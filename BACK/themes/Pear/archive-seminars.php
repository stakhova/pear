<?php /* Template Name: Seminars page */ ?>
<?php get_header(); ?>
<?php (new Seminars_Page_Banner_Section())->render()?>
<?php (new Seminars_Page_Content_Section())->render()?>
<?php get_footer(); ?>