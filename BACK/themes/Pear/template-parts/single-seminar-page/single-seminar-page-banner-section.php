<?php

class Single_Seminar_Page_Banner_Section
{
    public function __construct()
    {
        $main_options = get_field('main_options');
        $this->number_of_seats = $main_options['number_of_seats'];
        $this->dates = $main_options['dates'];
        $this->venue = $main_options['venue'];
        $this->price = $main_options['price'];

        $this->term = get_the_terms(get_the_ID(), 'seminar_theme')[0]->name;
    }

    public function render()
    { ?>

        <section class="section__banner section__banner-seminar grey">
            <div class="container">
                <div class="section__banner-flex">
                    <div class="section__banner-info">
                        <div class="banner__tag">
                            <div class="banner__tag-item green">
                                <div class="img"> <img src="<?= TEMPLATE_PATH ?>/img/loc-white.svg" alt=""></div>
                                <span><?php echo $this->venue; ?></span>

                            </div>
                            <div class="banner__tag-item green">
                                <span><?php echo $this->term; ?></span>
                            </div>
                            <div class="banner__tag-item ">
                                <span>Noch <?php echo $this->number_of_seats; ?> Tage</span>
                            </div>
                        </div>
                        <h1 class="section__middle"><?php echo get_the_title(); ?></h1>
                        <div class="registration__flex">
                            <div class="registration__item">
                                <span class="registration__item-title">Dates</span>
                                <?php foreach ($this->dates as $date) : ?>

                                    <?php
                                    $germanMonths = [
                                        1 => 'JAN.',
                                        'FEB.',
                                        'MÄR.',
                                        'APR.',
                                        'MAI',
                                        'JUN.',
                                        'JUL.',
                                        'AUG.',
                                        'SEP.',
                                        'OKT.',
                                        'NOV.',
                                        'DEZ.'
                                    ];
                                    list($day, $month, $year) = explode('/', $date['date']);
                                    $formattedDate = sprintf("%02d %s %02d", $day, $germanMonths[(int)$month], $year % 100);
                                    ?>
                                    <p class="registration__item-text"><?php echo $formattedDate; ?></p>
                                <?php endforeach; ?>
                            </div>

                            <div class="registration__item">
                                <span class="registration__item-title">Time</span>
                                <?php foreach ($this->dates as $date) : ?>
                                    <p class="registration__item-text"><?php echo $date['time']; ?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="section__banner-seminar-button">
                            <a href="#form" class="section__button primary">Registrieren</a>
                            <span><?php echo $this->price; ?> Euro / Person</span>
                        </div>

                    </div>
                    <div class="section__banner-seminar-img img">
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                    </div>
                </div>


            </div>
        </section>
<? }
}
