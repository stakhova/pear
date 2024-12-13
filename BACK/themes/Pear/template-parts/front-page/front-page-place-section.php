<?php

class Front_Page_Place_Section
{
    public function __construct() {
        $section_seminars = get_field('section_seminars');
        $this->subtitle = $section_seminars['subtitle'];
        $this->title = $section_seminars['title'];
        $this->button = $section_seminars['button'];

        $section_form = get_field('section_form');
        $this->form_title = $section_form['title'];
        $this->form_text = $section_form['text'];
        $this->policy_text = $section_form['policy_text'];
    }

    public function render()
    { ?>

        <section class="section grey place">

            <div class="place__back img">
                <img src="<?=TEMPLATE_PATH?>/img/bottom.png" alt="">
            </div>
            <div class="container">
                <div class="section__top">
                    <div class="section__top-left">
                        <?php if (!empty($this->subtitle)) : ?>
                            <p class="section__category"><?php echo $this->subtitle; ?></p>
                        <?php endif; ?>
                        <?php if (!empty($this->title)) : ?>
                            <h2 class="section__title"><?php echo $this->title; ?></h2>
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
                            <a href="" class="card__item green swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                    <span class="card__flag left"> in Kürze</span>
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
                            <a href="" class="card__item swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                    <span class="card__flag left"> in Kürze</span>
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
                            <a href="" class="card__item swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                    <span class="card__flag left"> in Kürze</span>
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
                            <a href="" class="card__item swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                    <span class="card__flag left"> in Kürze</span>
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
                            <a href="" class="card__item swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                    <span class="card__flag left"> in Kürze</span>
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
                            <a href="" class="card__item swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                    <span class="card__flag left"> in Kürze</span>
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
                <div class="section__form">
                    <div class="section__form-info">
                        <div class="section__more">
                            <div class="section__form-content content">
                                <?php if (!empty($this->form_title)) : ?>
                                    <h3><?php echo $this->form_title; ?></h3>
                                <?php endif; ?>
                                <?php if (!empty($this->form_text)) : ?>
                                    <?php echo $this->form_text; ?>
                                <?php endif; ?>
                            </div>
                            <button class="section__more-btn">Mehr Information</button>
                        </div>

                    </div>
                    <form action="" class="form form__seminar">
                        <input type="hidden" name="action" value="front_request">
                        <div class="form__input">
                            <label>voller Name</label>
                            <input type="text" name="name" placeholder="Max Mustermann">
                        </div>
                        <div class="form__input">
                            <label>E-Mail</label>
                            <input type="text" name="email" placeholder="example@mail.com">
                        </div>
                        <div class="form__input">
                            <label>Telefonnummer</label>
                            <input type="text" name="phone" placeholder="+49 XXX XXXXXXXX">
                        </div>
                        <div class="form__input textarea">
                            <label>Deine Anfrage</label>
                            <textarea name="message" placeholder="Ich möchte..."></textarea>
                        </div>
                        <div class="form__checkbox">
                            <input type="checkbox" id="check" name="policy_terms">
                            <label for="check"><?php echo str_replace(['<p>','</p>'],['',''],$this->policy_text); ?></label>
                        </div>
                        <button class="section__button primary">Senden</button>
                    </form>
                </div>

            </div>
        </section>
<? }
}
