<?php /* Template Name: Front page */ ?>
<?php get_header(); ?>
<?php (new Front_Page_Banner_Section())->render()?>
<?php (new Front_Page_Promise_Section())->render()?>
<?php (new Front_Page_Place_Section())->render()?>
<?php (new Front_Page_Exclusive_Section())->render()?>
<?php (new Front_Page_Improve_Section())->render()?>
<?php (new Front_Page_Competence_Section())->render()?>
<?php (new Front_Page_Partners_Section())->render()?>
<?php (new Front_Page_Contact_Section())->render()?>
<?php get_footer(); ?>