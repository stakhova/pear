<?php

class Campus_Page_Banner_Section
{
    public function __construct() {
        $section_banner = get_field('section_banner');
        $this->image = $section_banner['image'];
        $this->title = $section_banner['title'];
        $this->text = $section_banner['text'];
        $this->button = $section_banner['button'];
    }

    public function render()
    { ?>

        <section class="banner banner__campus">
            <?php if (!empty($this->image)) : ?>
                <div class="banner__img img">
                    <img src="<?php echo $this->image; ?>" alt="">
                </div>
            <?php endif; ?>
            <div class="container">
                <div class="banner__flex section__flex">
                    <div class="banner__info">
                        <?php if (!empty($this->title)) : ?>
                            <h1 class="section__title white"><?php echo $this->title; ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($this->text)) : ?>
                            <h3 class="banner__text"><?php echo $this->text; ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($this->button)) : ?>
                            <a href="<?php echo $this->button['url']; ?>" target="<?php echo $this->button['target']; ?>" class="section__button primary arrow"><?php echo $this->button['title']; ?></a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </section>
<? }
}
