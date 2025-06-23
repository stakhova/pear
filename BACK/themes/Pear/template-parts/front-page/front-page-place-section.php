<?php

class Front_Page_Place_Section
{
    public function __construct()
    {
        $section_seminars = get_field('section_seminars');
        $this->subtitle = $section_seminars['subtitle'];
        $this->title = $section_seminars['title'];
        $this->button = $section_seminars['button'];
        $this->seminars = $section_seminars['seminars'];

        $section_form = get_field('section_form');
        $this->form_title = $section_form['title'];
        $this->form_text = $section_form['text'];
        $this->policy_text = $section_form['policy_text'];
        $this->name = $section_form['Name'];
        $this->email = $section_form['Email'];
        $this->field_text = $section_form['field_text'];
        $this->field_text_placeholder = $section_form['field_text_placeholder'];
    }

    public function render()
    { ?>

        <section class="section grey place">

            <div class="place__back img">
                <img src="<?= TEMPLATE_PATH ?>/img/bottom.png" alt="">
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
                            <input type="hidden" name="post_type" value="seminar">
                            <div class="section__search-input">
                                <input type="text" name="s" placeholder="Seminar suchen…">
                            </div>
                            <button><span>Suche</span></button>
                        </form>
                        <?php if (!empty($this->button)) : ?>
                            <a href="<?php echo $this->button['url']; ?>" class="section__button primary"><?php echo $this->button['title']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (!empty($this->seminars)) : ?>
                    <div class="card__block">
                        <div class="swiper card__slider">
                            <div class="card__list swiper-wrapper">
                                <?php foreach ($this->seminars as $post) : ?>
                                    <a href="<?php echo get_the_permalink($post->ID); ?>" class="card__item <?php echo (get_field('main_options', $post->ID)['shortly'] ? 'green' : '') ?> swiper-slide">
                                        <div class="card__img img">
                                            <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="">
                                            <span class="card__flag right"><?php echo get_field('main_options', $post->ID)['number_of_seats']; ?> Plätze</span>
                                            <?php if (get_field('shortly', $post->ID)['shortly']) : ?>
                                                <span class="card__flag left"> in Kürze</span>
                                            <?php endif; ?>
                                        </div>
                                        <?php
                                        $germanMonths = [
                                            1 => 'JAN',
                                            'FEB',
                                            'MÄR',
                                            'APR',
                                            'MAI',
                                            'JUN',
                                            'JUL',
                                            'AUG',
                                            'SEP',
                                            'OKT',
                                            'NOV',
                                            'DEZ'
                                        ];
                                        $dates = get_field('main_options', $post->ID)['dates'];
                                        if (count($dates) == 1) {
                                            list($day, $month, $year) = explode('/', $dates[0]['date']);

                                            $formattedDate = sprintf("%02d. %s %02d", $day, $germanMonths[(int)$month], $year % 100);
                                        } else {

                                            $formatDate = function ($date) use ($germanMonths) {
                                                list($day, $month, $year) = explode('/', $date);
                                                return sprintf("%02d. %s", $day, $germanMonths[(int)$month]);
                                            };

                                            $formattedDate1 = $formatDate($dates[0]['date']);
                                            $formattedDate2 = $formatDate($dates[count($dates) - 1]['date']);

                                            $year = explode('/', $dates[count($dates) - 1]['date'])[2] % 100;

                                            $formattedDate = "{$formattedDate1} - {$formattedDate2} {$year}";
                                        }
                                        ?>
                                        <div class="card__info">
                                            <div class="card__date">
                                                <span><?php echo $formattedDate; ?></span>
                                                <span class="card__date-loc <?php echo (get_field('main_options', $post->ID)['venue'] == 'online') ? 'online' : '' ?>"><?php echo get_field('main_options', $post->ID)['venue']; ?></span>
                                            </div>
                                            <h3 class="card__title"><?php echo get_the_title($post->ID); ?>
                                            </h3>
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
                            <label><?php echo $this->name; ?></label>
                            <div class="form__input-wrap">
                                <input type="text" name="name" placeholder="Max Mustermann">
                            </div>
                        </div>
                        <div class="form__input">
                            <label><?php echo $this->email; ?></label>
                            <div class="form__input-wrap">
                                 <input type="text" name="email" placeholder="example@mail.com">
                            </div>
                        </div>
                        <div class="form__input">
                            <label>Telefonnummer</label>
                            <div class="form__input-wrap">
                                <input type="text" name="phone" placeholder="+49 XXX XXXXXXXX">
                            </div>
                        </div>
                        <div class="form__input textarea">
                            <label><?php echo $this->field_text; ?></label>
                            <div class="form__input-wrap">
                                <textarea name="message" placeholder="<?php echo $this->field_text_placeholder; ?>"></textarea>
                            </div>
                        </div>
                        <div class="form__checkbox">
                            <input type="checkbox" id="check" name="policy_terms">
                            <label for="check"><?php echo str_replace(['<p>', '</p>'], ['', ''], $this->policy_text); ?></label>
                        </div>
                        <button class="section__button primary">Senden</button>
                    </form>
                </div>

            </div>
        </section>
<? }
}
