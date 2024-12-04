<?php

class Failed_Payment_Page_Content_Section
{
    public function __construct() {
        $section_content = get_field('section_content');
        $this->title = $section_content['title'];
        $this->text = $section_content['text'];
        $this->left_button = $section_content['left_button'];
        $this->rigth_button = $section_content['rigth_button'];
    }

    public function render()
    { ?>

        <section class="section__white">
            <div class="container">
                <div class="section__white-block">
                    <div class="section__white-icon error img">
                        <img src="<?=TEMPLATE_PATH?>/img/error.svg" alt="">
                    </div>
                    <?php if (!empty($this->title)) : ?>
                        <h1 class="section__title"><?php echo $this->title; ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($this->text)) : ?>
                        <p class="section__white-text"><?php echo $this->text; ?></p>
                    <?php endif; ?>
                    <div class="banner__button">
                        <?php if (!empty($this->left_button)) : ?>
                            <a href="<?php echo $this->left_button['url']; ?>" class="section__button primary"><?php echo $this->left_button['title']; ?></a>
                        <?php endif; ?>
                        <?php if (!empty($this->rigth_button)) : ?>
                            <a href="<?php echo $this->rigth_button['url']; ?>" class="section__button grey "><?php echo $this->rigth_button['title']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
<? }
}
