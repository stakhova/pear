<?php

class Front_Page_Exclusive_Section
{
    public function __construct()
    {
        $section_exclusive = get_field('section_exclusive');
        $this->title = $section_exclusive['title'];
        $this->text = $section_exclusive['text'];
        $this->button = $section_exclusive['button'];
        $this->seminars = $section_exclusive['seminars'];
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
                            <input type="hidden" name="post_type" value="seminar">
                            <input type="hidden" name="type" value="exklusiv">
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
                                    <a href="<?php echo get_the_permalink($post->ID); ?>" class="card__item yellow swiper-slide">
                                        <div class="card__img img">
                                            <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="">
                                            <span class="card__flag right"> Noch <?php echo get_field('main_options', $post->ID)['number_of_seats']; ?> Tage</span>
                                            <?php if (get_field('shortly', $post->ID)['shortly']) : ?>
                                                <span class="card__flag left"> in Kürze</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card__info">
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

                                                $year = explode('/', $dates[count($dates) - 1])[2] % 100;

                                                $formattedDate = "{$formattedDate1} - {$formattedDate2} {$year}";
                                            }
                                            ?>
                                            <div class="card__date">
                                                <span><?php echo $formattedDate; ?></span>
                                                <span class="card__date-loc"><?php echo get_field('main_options', $post->ID)['venue']; ?></span>
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

            </div>
        </section>
<? }
}
