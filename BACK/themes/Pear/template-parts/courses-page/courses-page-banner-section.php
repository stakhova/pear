<?php

class Courses_Page_Banner_Section
{
    public function __construct() {
        wp_reset_postdata();

        $section_banner = get_field('section_banner',Page_Courses::get_ID());
        $this->title = $section_banner['title'];
        $this->text = $section_banner['text'];
    }

    public function render()
    { ?>

        <section class="section__banner">
            <div class="container">
                <div class="section__banner-block">
                    <?php if (!empty($this->title)) : ?>
                        <h1 class="section__title white"><?php echo $this->title; ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($this->text)) : ?>
                    <p class="section__text white"><?php echo $this->text; ?></p>
                    <?php endif; ?>
                    <form class="section__search" action="<?php echo get_the_permalink(get_option('page_on_front')); ?>">
                        <input type="hidden" name="post_type" value="course">
                        <div class="section__search-input">
                            <input type="text" name="s" placeholder="Seminar suchen…">
                        </div>
                        <button><span>Suche</span></button>
                    </form>
                </div>
            </div>
        </section>
<? }
}
