<?php /* Template Name: Campus page */ ?>
<?php get_header(); ?>
<?php (new Campus_Page_Banner_Section())->render()?>
<?php (new Campus_Page_Content_Section())->render()?>
<?php (new Campus_Page_Form_Section())->render()?>
<?php get_footer(); ?>