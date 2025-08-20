<?php

class Single_Seminar_Page_Form_Section
{
    public function __construct()
    {
        $this->term = get_the_terms(get_the_ID(), 'seminar_theme')[0]->name;
        $main_options = get_field('main_options');
        $this->dates = $main_options['dates'];
        $this->price = $main_options['price'];
        $this->dates = $main_options['dates'];

        $section_form = get_field('section_form');
        $this->place = $section_form['place'];


        $dateToCheck = end($this->dates)['date'];

        $currentDate = date("d/m/Y");

        $timestampToCheck = DateTime::createFromFormat("d/m/Y", $dateToCheck)->getTimestamp();
        $currentTimestamp = DateTime::createFromFormat("d/m/Y", $currentDate)->getTimestamp();

        if ($timestampToCheck < $currentTimestamp) {
            $this->old_seminar = true;
        } else {
            $this->old_seminar = false;
        }

        $this->price_text = get_field('additional_texts', Page_Option::get_ID())['price_text'];

        $section_reviews = get_field('section_reviews');
        $this->reviews = $section_reviews['reviews'];

        $this->current_post_id = get_the_ID();
        $this->current_post_title = get_the_title(get_the_ID());

        $args_all = array(
            'post_type' => 'seminar',
            'posts_per_page' => 99999,
            'post__not_in'   => array(get_the_ID()),
            's'              => $this->current_post_title,
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
            ),
            'post__not_in'   => array(get_the_ID()),
            's'              => $this->current_post_title,
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
            ),
            'post__not_in'   => array(get_the_ID()),
            's'              => $this->current_post_title,
        );

        $this->query_ex = new WP_Query($args_ex);
    }

    public function render()
    { ?>

        <?php if (!$this->old_seminar) : ?>
            <?php if (empty($this->query_all->posts) and empty($this->query_reg->posts) and empty($this->query_ex->posts) and empty($this->reviews)) : ?>
                <section class="section" id="form" style="padding: 3rem;">
                <?php else : ?>
                    <section class="section" id="form">
                    <?php endif; ?>
                    <div class="container">
                        <div class="section__form grey registration">
                            <div class="section__form-info">
                                <h3 class="section__form-title">Anmeldung</h3>
                                <div class="registration__list">
                                    <div class="registration__item">
                                        <span class="registration__item-title">Thema</span>
                                        <p class="registration__item-text"><?php echo get_the_title(); ?></p>
                                    </div>
                                    <div class="registration__item">
                                        <span class="registration__item-title">Kategorie</span>
                                        <p class="registration__item-text"><?php echo $this->term; ?></p>
                                    </div>
                                    <div class="registration__flex">
                                        <div class="registration__item">
                                            <span class="registration__item-title">Datum</span>
                                            <?php foreach ($this->dates as $date) : ?>
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
                                                list($day, $month, $year) = explode('/', $date['date']);
                                                $formattedDate = sprintf("%02d. %s %02d", $day, $germanMonths[(int)$month], $year % 100);
                                                ?>
                                                <p class="registration__item-text"><?php echo $formattedDate; ?></p>
                                            <?php endforeach; ?>
                                        </div>

                                        <div class="registration__item">
                                            <span class="registration__item-title">Zeit</span>
                                            <?php foreach ($this->dates as $date) : ?>
                                                <p class="registration__item-text"><?php echo $date['time']; ?></p>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php if (!empty($this->place)) : ?>
                                        <div class="registration__item">
                                            <span class="registration__item-title">Standort</span>
                                            <p class="registration__item-text"><?php echo $this->place; ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="registration__item">
                                        <span class="registration__item-title">Kosten</span>
                                        <p class="registration__item-text"><?php echo $this->price; ?> Euro / Person</p>
                                    </div>
                                </div>


                            </div>
                            <form action="" class="form form__seminar-full">
                                <input type="hidden" name="seminar_id" value="<?php echo get_the_ID(); ?>">
                                <input type="hidden" name="action" value="seminar_request">
                                <input type="hidden" name="count" value="1">


                                <div class="form__block">
                                    <h2 class="form__block-title">Rechnungsinformationen</h2>
                                    <div class="form__flex">
                                        <div class="form__input">
                                            <label>Vorname und Nachname</label>
                                            <div class="form__input-wrap">
                                                <input type="text" name="name[]"  placeholder="Max Mustermann">
                                            </div>
                                        </div>
                                        <div class="form__input">
                                            <label>Firmenname</label>
                                            <div class="form__input-wrap">
                                                <input type="text" name="company" placeholder="Firma">
                                            </div>
                                        </div>
                                        <div class="form__input">
                                            <label>Adresse Der firma</label>
                                            <div class="form__input-wrap">
                                                <input type="text" name="address" placeholder="Adresse">
                                            </div>
                                        </div>
                                        <div class="form__input">
                                            <label>Stadt</label>
                                            <div class="form__input-wrap">
                                                <input type="text" name="state" placeholder="München">
                                            </div>
                                        </div>
                                        <div class="form__input">
                                            <label>Postleitzahl</label>
                                            <div class="form__input-wrap">
                                                <input type="text" name="post_code" placeholder="XXXXX">
                                            </div>
                                        </div>
                                        <div class="form__input">
                                            <label>Telefonnummer</label>
                                            <div class="form__input-wrap">
                                                <input type="text" name="phone" placeholder="+49 XXX XXXXXXXX">
                                            </div>
                                        </div>
                                        <div class="form__input">
                                            <label>E-Mail</label>
                                            <div class="form__input-wrap">
                                                <input type="text" name="email[]"  placeholder="example@mail.com">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form__block  form__block-bottom">
                                    <h2 class="form__block-title">Teilnehmer</h2>
                                    <div class="form__input ">
                                        <label>Anzahl der Teilnehmer</label>
                                        <div class="form__button-counter">
                                            <div class="form__button-count form__button-count-minus"></div>
                                            <span>1</span>
                                            <div class="form__button-count form__button-count-plus"></div>
                                        </div>
                                    </div>

                                    <div class="form__block-person">
                                    </div>
                                </div>



                                <div class="form__checkbox">
                                    <input type="checkbox" id="check" name="policy_terms">
                                    <label for="check">Ich habe die <a href="">Datenschutzerklärung </a> gelesen und stimme der Verarbeitung
                                        meiner Daten zur Kontaktaufnahme und Bearbeitung meiner Anfrage zu.</label>
                                </div>
                                <div class="form__button">
                                    <button class="section__button primary " data-price="<?php echo $this->price; ?>">
                                        <p>Platz sichern</p>
                                        <div class="price"><span><?php echo $this->price; ?></span> Euro</div>
                                    </button>

                                </div>
                                <?php if (!empty($this->price_text)) : ?>
                                    <div class="price__wrap">
                                        <p><?php echo $this->price_text; ?></p>
                                    </div>

                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                    </section>
                <?php endif; ?>
        <? }
}
