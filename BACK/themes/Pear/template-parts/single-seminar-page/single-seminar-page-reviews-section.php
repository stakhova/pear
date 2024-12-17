<?php

class Single_Seminar_Page_Reviews_Section
{
    public function __construct()
    {
        $section_reviews = get_field('section_reviews');
        $this->reviews = $section_reviews['reviews'];
    }

    public function render()
    { ?>

        <?php if (!empty($this->reviews)) : ?>
            <section class="section review ">
                <div class="container">
                    <div class="review__block ">
                        <div class="swiper review__slider">
                            <div class="review__list swiper-wrapper">
                                <?php foreach ($this->reviews as $item) : ?>
                                    <div class="review__item swiper-slide">
                                        <div class="card__star" data-star="5"></div>
                                        <p class="section__text"><?php echo $item['text']; ?></p>
                                        <p class="review__author">– <?php echo $item['name']; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="card__nav review__nav ">
                            <button class="swiper-button-prev card__prev"></button>
                            <button class="swiper-button-next card__next"></button>
                        </div>
                    </div>
                </div>

            </section>
        <?php endif; ?>
<? }
}
