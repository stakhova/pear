<?php

class Single_Seminar_Page_Alternative_Section
{
    public function __construct()
    {

        $args_all = array(
            'post_type' => 'seminar',
            'posts_per_page' => 99999,
        );

        $this->query_all = new WP_Query($args_all);

        $args_reg = array(
            'post_type' => 'seminar',
            'posts_per_page' => 99999,
            'tax_query' => array(
                array(
                    'taxonomy' => 'seminar_type',
                    'field'    => 'slug',
                    'terms'    => array('regular'),
                    'operator' => 'IN',
                )
            )
        );

        $this->query_reg = new WP_Query($args_reg);

        $args_ex = array(
            'post_type' => 'seminar',
            'posts_per_page' => 99999,
            'tax_query' => array(
                array(
                    'taxonomy' => 'seminar_type',
                    'field'    => 'slug',
                    'terms'    => array('exklusiv'),
                    'operator' => 'IN',
                )
            )
        );

        $this->query_ex = new WP_Query($args_ex);

    }

    public function render()
    { ?>

        <section class="section alternative">
            <div class="container">
                <div class="section__top">
                    <div class="section__top-left">
                        <h2 class="section__title">Alternative Daten</h2>
                    </div>
                    <div class="tab">
                        <div class="tab__header ">
                            <?php if (!empty($this->query_all->posts)) : ?>
                                <button class="tab__header-item">Alle Typen</button>
                            <?php endif; ?>
                            <?php if (!empty($this->query_reg->posts)) : ?>
                                <button class="tab__header-item">Regulär</button>
                            <?php endif; ?>
                            <?php if (!empty($this->query_ex->posts)) : ?>
                                <button class="tab__header-item">Exklusiv</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card__block">
                    <div class="tab__content ">
                        <?php if (!empty($this->query_all->posts)) : ?>
                            <div class="tab__content-item">
                                <div class="card__list ">
                                    <?php foreach ($this->query_all->posts as $post) : ?>
                                        <?php if (has_term('exklusiv', 'seminar_type', $post->ID)) : ?>
                                            <a href="<?php echo get_the_permalink($post->ID); ?>" class="card__item yellow">
                                            <?php else : ?>
                                                <a href="<?php echo get_the_permalink($post->ID); ?>" class="card__item <?php echo (get_field('main_options', $post->ID)['shortly'] ? 'green' : 'gray') ?>  ">
                                                <?php endif; ?>
                                                <div class="card__img img">
                                                    <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="">
                                                    <span class="card__flag right"> Noch <?php echo get_field('main_options', $post->ID)['number_of_seats']; ?> Orte</span>
                                                    <span class="card__flag left"> in Kürze</span>
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
                                                <?php //if (!empty(get_field('main_options', $post->ID)['short_description'])) : ?>
                                                    <!-- <div class="card__hover">
                                                        <div class="card__hover-content content">
                                                            <h3><?php echo get_the_title($post->ID); ?></h3>
                                                            <?php echo get_field('main_options', $post->ID)['short_description']; ?>
                                                        </div>

                                                    </div> -->
                                                <?php //endif; ?>
                                                </a>
                                            <?php endforeach; ?>

                                </div>
                                <a href="<?php echo Page_Seminars::get_url(); ?>" class="section__button grey">Mehr anzeigen</a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($this->query_reg->posts)) : ?>
                            <div class="tab__content-item">
                                <div class="card__list ">
                                    <?php foreach ($this->query_reg->posts as $post) : ?>
                                        <?php if (has_term('exklusiv', 'seminar_type', $post->ID)) : ?>
                                            <a href="<?php echo get_the_permalink($post->ID); ?>" class="card__item yellow">
                                            <?php else : ?>
                                                <a href="<?php echo get_the_permalink($post->ID); ?>" class="card__item <?php echo (get_field('main_options', $post->ID)['shortly'] ? 'green' : 'gray') ?>  ">
                                                <?php endif; ?>
                                                <div class="card__img img">
                                                    <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="">
                                                    <span class="card__flag right"> Noch <?php echo get_field('main_options', $post->ID)['number_of_seats']; ?> Orte</span>
                                                    <span class="card__flag left"> in Kürze</span>
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
                                                <?php //if (!empty(get_field('main_options', $post->ID)['short_description'])) : ?>
                                                    <!-- <div class="card__hover">
                                                        <div class="card__hover-content content">
                                                            <h3><?php echo get_the_title($post->ID); ?></h3>
                                                            <?php echo get_field('main_options', $post->ID)['short_description']; ?>
                                                        </div>

                                                    </div> -->
                                                <?php //endif; ?>
                                                </a>
                                            <?php endforeach; ?>

                                </div>
                                <button  class="section__button grey">Mehr anzeigen</button>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($this->query_ex->posts)) : ?>
                            <div class="tab__content-item">
                                <div class="card__list ">
                                    <?php foreach ($this->query_ex->posts as $post) : ?>
                                        <?php if (has_term('exklusiv', 'seminar_type', $post->ID)) : ?>
                                            <a href="<?php echo get_the_permalink($post->ID); ?>" class="card__item yellow">
                                            <?php else : ?>
                                                <a href="<?php echo get_the_permalink($post->ID); ?>" class="card__item <?php echo (get_field('main_options', $post->ID)['shortly'] ? 'green' : 'gray') ?>  ">
                                                <?php endif; ?>
                                                <div class="card__img img">
                                                    <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="">
                                                    <span class="card__flag right"> Noch <?php echo get_field('main_options', $post->ID)['number_of_seats']; ?> Orte</span>
                                                    <span class="card__flag left"> in Kürze</span>
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
                                                <?php //if (!empty(get_field('main_options', $post->ID)['short_description'])) : ?>
                                                    <!-- <div class="card__hover">
                                                        <div class="card__hover-content content">
                                                            <h3><?php echo get_the_title($post->ID); ?></h3>
                                                            <?php echo get_field('main_options', $post->ID)['short_description']; ?>
                                                        </div>

                                                    </div> -->
                                                <?php //endif; ?>
                                                </a>
                                            <?php endforeach; ?>

                                </div>
                                <a href="<?php echo Page_Seminars::get_url() . 'type=exklusiv'; ?>" class="section__button grey">Mehr anzeigen</a>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

            </div>
        </section>
<? }
}
