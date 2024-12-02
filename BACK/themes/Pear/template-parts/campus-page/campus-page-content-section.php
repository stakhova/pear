<?php

class Campus_Page_Content_Section
{
    public function __construct() {
        $section_content = get_field('section_content');
        $this->items = $section_content['items'];
    }

    public function render()
    { ?>
        <?php if (!empty($this->items)) : ?>
            <section class="section  campus">
                <div class="container">
                    <div class="card__block">
                        <div class="swiper card__slider">
                            <div class="card__list swiper-wrapper">
                                <?php foreach ($this->items as $item) : ?>
                                    <div class="card__item competence__item swiper-slide">
                                        <div class="card__img">
                                            <div class="competence__img img">
                                                <img src="<?php echo $item['icon']; ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="card__info">
                                            <h3 class="card__title"><?php echo $item['title']; ?></h3>
                                            <p class="card__text"><?php echo $item['text']; ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="card__nav">
                            <button class="swiper-button-prev card__prev"></button>
                            <button class="swiper-button-next card__next"></button>
                        </div>
                    </div>
                </div>

            </section>
        <?php endif; ?>
<? }
}
