<?php

class Front_Page_Partners_Section
{
    public function __construct() {
        $section_partners = get_field('section_partners');
        $this->title = $section_partners['title'];
        $this->items = $section_partners['items'];
    }

    public function render()
    { ?>

        <section class="section partners">
            <div class="container">
                <div class="partners__block">
                    <div class="section__center">
                        <?php if (!empty($this->title)) : ?>
                            <h2 class="section__title"><?php echo $this->title; ?></h2>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($this->items)) : ?>
                        <div class="swiper partners__slide">
                            <div class="partners__list swiper-wrapper">
                                <?php foreach ($this->items as $item) : ?>
                                    <div class="partners__item swiper-slide">
                                        <div class="partners__img img ">
                                            <img src="<?php echo $item['image']; ?>" alt="">
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                </div>

            </div>

        </section>
<? }
}
