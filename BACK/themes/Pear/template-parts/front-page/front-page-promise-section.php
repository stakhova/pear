<?php

class Front_Page_Promise_Section
{
    public function __construct() {
        $section_info = get_field('section_info');
        $this->image = $section_info['image'];
        $this->subtitle = $section_info['subtitle'];
        $this->title = $section_info['title'];
        $this->items = $section_info['items'];
    }

    public function render()
    { ?>

        <section class="section promise">

            <div class="container">
                <div class="promise__block section__flex">
                    <?php if (!empty($this->image)) : ?>
                        <div class="promise__img img">
                            <img src="<?php echo $this->image; ?>" alt="">
                        </div>
                    <?php endif; ?>
                    <div class="promise__info">
                        <div class="promise__back img">
                            <img src="<?=TEMPLATE_PATH?>/img/top.png" alt="">
                        </div>
                        <?php if (!empty($this->subtitle)) : ?>
                            <p class="section__category"><?php echo $this->subtitle; ?></p>
                        <?php endif; ?>
                        <?php if (!empty($this->title)) : ?>
                        <h2 class="promise__title"><?php echo $this->title; ?></h2>
                        <?php endif; ?>
                        <?php if (!empty($this->items)) : ?>
                            <div class="section__flex promise__count-wrap">
                                <?php foreach ($this->items as $item) : ?>
                                    <div class="promise__count">
                                        <h4><span class="counter" data-target="<?php echo $item['title']; ?>">0</span>+</h4>
                                        <p class="section__text"><?php echo $item['text']; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
<? }
}
