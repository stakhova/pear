<?php get_header(); ?>
<?php if (get_queried_object()->taxonomy == 'course_type') : ?>
    <?php (new Courses_Page_Banner_Section())->render() ?>
    <?php (new Courses_Page_Content_Section())->render() ?>
<?php else : ?>
    <?php (new Seminars_Page_Banner_Section())->render() ?>
    <?php (new Seminars_Page_Content_Section())->render() ?>
<?php endif; ?>
<?php get_footer(); ?>