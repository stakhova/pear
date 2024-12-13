<?php

class Front_Page_Improve_Section
{
    public function __construct()
    {
        $section_courses = get_field('section_courses');
        $this->title = $section_courses['title'];
        $this->text = $section_courses['text'];
        $this->button = $section_courses['button'];
        $this->courses = $section_courses['courses'];
    }

    public function render()
    { ?>

        <section class="section improve">
            <div class="container">
                <div class="section__top">
                    <div class="section__top-left">
                        <?php if (!empty($this->title)) : ?>
                            <h2 class="section__title"><?php echo $this->title; ?></h2>
                        <?php endif; ?>
                        <?php if (!empty($this->text)) : ?>
                            <p class="section__text"><?php echo $this->text; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="section__top-search">
                        <form class="section__search">
                            <input type="hidden" name="action" value="search">
                            <div class="section__search-input">
                                <input type="text" name="search" placeholder="Seminar suchen…">
                            </div>
                            <button><span>Suche</span></button>
                        </form>
                        <?php if (!empty($this->button)) : ?>
                            <a href="<?php echo $this->button['url']; ?>" class="section__button primary"><?php echo $this->button['title']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (!empty($this->courses)) : ?>
                    <div class="card__block">
                        <div class="swiper card__slider">
                            <div class="card__list swiper-wrapper">
                                <?php foreach ($this->courses as $item) : ?>
                                    <a href="<?php echo get_the_permalink($item) ?>" class="card__item grey">
                                        <div class="card__img img">
                                            <img src="<?php echo get_the_post_thumbnail_url($item); ?>" alt="">
                                        </div>
                                        <div class="card__info">
                                            <div class="card__info-top">
                                                <?php if (!empty(get_field('main_options', $item)['certificate'])) : ?>
                                                    <span class="card__iso"><?php echo get_field('main_options', $item)['certificate']; ?></span>
                                                <?php endif; ?>
                                                <?php if (!empty(get_field('main_options', $item)['reviews_count'])) : ?>
                                                    <div class="card__star" data-star="5"><span>(<?php echo get_field('main_options', $item)['reviews_count']; ?>)</span></div>
                                                <?php endif; ?>
                                            </div>
                                            <h3 class="card__title"><?php echo get_the_title($item); ?></h3>
                                        </div>
                                    </a>
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
