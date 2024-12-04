<?php /* Template Name: Courses page */ ?>
<?php get_header(); ?>
<?php (new Courses_Page_Banner_Section())->render()?>
<?php (new Courses_Page_Content_Section())->render()?>
<?php get_footer(); ?>