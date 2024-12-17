<?php

class Calendar_Page_Banner_Section
{
    public function __construct() {
        $section_banner = get_field('section_banner');
        $this->title = $section_banner['title'];
        $this->text = $section_banner['text'];
        $this->button = $section_banner['button'];
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
                    <?php if (!empty($this->button)) : ?>
                        <a href="<?php echo $this->button['url']; ?>" class="section__button transparent"><?php echo $this->button['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
<? }
}
