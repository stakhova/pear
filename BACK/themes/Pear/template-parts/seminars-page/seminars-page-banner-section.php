<?php

class Seminars_Page_Banner_Section
{
    public function __construct() {
        $section_banner = get_field('section_banner',Page_Seminars::get_ID());
        $this->title = $section_banner['title'];
        $this->text = $section_banner['text'];
        $this->button = $section_banner['button'];

        $section_exclusive = get_field('section_exclusive',get_option('page_on_front'));
        $this->front_text = $section_exclusive['text'];
    }

    public function render()
    { ?>

        <section class="section__banner section__banner-hide ">
            <div class="container">
                <div class="section__banner-block">
                    <?php if (!empty($this->title)) : ?>
                        <h1 class="section__title white"><?php echo $this->title; ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($_GET['type']) and $_GET['type']=='exklusiv') : ?>
                    <div class="section__more">
                        <div class="section__banner-hide-wrap section__form-content">
                            <?php echo str_replace('<p>','<p class="section__text white">',$this->front_text); ?>
                            <button class="section__more-btn" style="display: inline-block;">Mehr Information</button>
                        </div>
                    </div>
                        <?php else : ?>
                        <?php if (!empty($this->text)) : ?>
                            <p class="section__text white"><?php echo $this->text; ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (!empty($this->button)) : ?>
                        <a href="<?php echo $this->button['url']; ?>" class="section__button transparent"><?php echo $this->button['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
<? }
}
