<?php

class Front_Page_Exclusive_Section
{
    public function __construct() {
        $section_exclusive = get_field('section_exclusive');
        $this->title = $section_exclusive['title'];
        $this->text = $section_exclusive['text'];
        $this->button = $section_exclusive['button'];
    }

    public function render()
    { ?>

        <section class="section exclusive  ">
            <div class="container">
                <div class="section__top">
                    <div class="section__top-left">
                        <?php if (!empty($this->title)) : ?>
                            <h2 class="section__title"><?php echo $this->title; ?></h2>
                        <?php endif; ?>
                        <?php if (!empty($this->text)) : ?>
                            <div class="section__more">
                                    <div class="section__form-content content ">
                                        <?php echo $this->text; ?>

                                    </div>
                                <button class="section__more-btn">Mehr Information</button>
                            </div>
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
                <div class="card__block">
                    <div class="swiper card__slider">
                        <div class="card__list swiper-wrapper">
                            <a href="" class="card__item yellow swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                </div>
                                <div class="card__info">
                                    <div class="card__date">
                                        <span>03 OKT. 24</span>
                                        <span class="card__date-loc">Bamberg</span>
                                    </div>
                                    <h3 class="card__title"> Seminar: QSV - Risk minimization and liability distribution
                                    </h3>
                                </div>
                            </a>
                            <a href="" class="card__item yellow swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                </div>
                                <div class="card__info">
                                    <div class="card__date ">
                                        <span>03 OKT. 24</span>
                                        <span class="card__date-loc online">online</span>
                                    </div>
                                    <h3 class="card__title"> Seminar: QSV - Risk minimization and liability distribution
                                    </h3>
                                </div>
                            </a>
                            <a href="" class="card__item yellow swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                </div>
                                <div class="card__info">
                                    <div class="card__date ">
                                        <span>03 OKT. 24</span>
                                        <span class="card__date-loc online">online</span>
                                    </div>
                                    <h3 class="card__title"> Seminar: QSV - Risk minimization and liability distribution
                                    </h3>
                                </div>
                            </a>

                        </div>
                    </div>
                    <div class="card__nav">
                        <button class="swiper-button-prev card__prev"></button>
                        <button class="swiper-button-next card__next"></button>
                    </div>
                </div>

            </div>
        </section>
<? }
}
