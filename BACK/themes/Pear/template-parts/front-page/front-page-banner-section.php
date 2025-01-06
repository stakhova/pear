<?php

class Front_Page_Banner_Section
{
    public function __construct() {
        $section_banner = get_field('section_banner');
        $this->title = $section_banner['title'];
        $this->text = $section_banner['text'];
        $this->left_button = $section_banner['left_button'];
        $this->rigth_button = $section_banner['rigth_button'];
        $this->image = $section_banner['image'];
    }

    public function render()
    { ?>

        <section class="banner banner__front">
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
                        <div class="banner__info-bottom">
                            <?php if (!empty($this->text)) : ?>
                                <h3 class="banner__subtitle"><?php echo $this->text; ?></h3>
                            <?php endif; ?>
                            <div class="banner__button">
                                <?php if (!empty($this->left_button)) : ?>
                                    <a href="<?php echo $this->left_button['url']; ?>" class="section__button primary"><?php echo $this->left_button['title']; ?></a>
                                <?php endif; ?>
                                <?php if (!empty($this->rigth_button)) : ?>
                                    <a href="<?php echo $this->rigth_button['url']; ?>" class="section__button "><?php echo $this->rigth_button['title']; ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
<? }
}
