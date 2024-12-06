<?php /* Template Name: Text page */ ?>
<?php get_header(); ?>
<?php (new Text_Page_Banner_Section())->render()?>
<?php (new Text_Page_Editor_Section())->render()?>
<?php get_footer(); ?>