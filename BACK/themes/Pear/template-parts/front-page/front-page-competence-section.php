<?php

class Front_Page_Competence_Section
{
    public function __construct() {
        $section_competence = get_field('section_competence');
        $this->title = $section_competence['title'];
        $this->text = $section_competence['text'];
        $this->items = $section_competence['items'];
    }

    public function render()
    { ?>

        <section class="section competence">
            <div class="container">
                <div class="section__center">
                    <?php if (!empty($this->title)) : ?>
                        <h2 class="section__title"> <?php echo $this->title; ?></h2>
                    <?php endif; ?>
                    <?php if (!empty($this->text)) : ?>
                    <p class="section__text"><?php echo $this->text; ?></p>
                    <?php endif; ?>
                </div>
                <?php if (!empty($this->items)) : ?>
                    <div class="card__block">
                        <div class="swiper card__slider">
                            <div class="card__list swiper-wrapper">
                                <?php foreach ($this->items as $item) : ?>
                                    <div class="card__item competence__item swiper-slide">
                                        <div class="card__img">
                                            <div class="competence__img img">
                                                <img src="<?php echo $item['icons']; ?>" alt="">
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
                <?php endif; ?>
            </div>

        </section>
<? }
}
