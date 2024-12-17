<?php

class Single_Seminar_Page_Form_Section
{
    public function __construct()
    {
        $this->term = get_the_terms(get_the_ID(), 'seminar_theme')[0]->name;
        $main_options = get_field('main_options');
        $this->dates = $main_options['dates'];
        $this->price = $main_options['price'];

        $section_form = get_field('section_form');
        $this->place = $section_form['place'];

    }

    public function render()
    { ?>

        <section class="section" id="form">
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
                        <div class="form__input">
                            <label>voller Name</label>
                            <input type="text" name="name" placeholder="Max Mustermann">
                        </div>
                        <div class="form__flex">
                            <div class="form__input">
                                <label>Firmenname</label>
                                <input type="text" name="company" placeholder="Firma">
                            </div>
                            <div class="form__input">
                                <label>Adresse der Firma</label>
                                <input type="text" name="address" placeholder="Geschäftsadresse">
                            </div>
                            <div class="form__input">
                                <label>Stadt</label>
                                <input type="text" name="state" placeholder="München">
                            </div>
                            <div class="form__input">
                                <label>Postleitzahl</label>
                                <input type="text" name="post_code" placeholder="XXXXX">
                            </div>
                            <div class="form__input">
                                <label>Telefonnummer</label>
                                <input type="text" name="phone" placeholder="+49 XXX XXXXXXXX">
                            </div>
                            <div class="form__input">
                                <label>E-Mail</label>
                                <input type="text" name="email" placeholder="example@mail.com">
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
                            <div class="form__button-counter">
                                <div class="form__button-count form__button-count-minus"></div>
                                <span>1</span>
                                <div class="form__button-count form__button-count-plus"></div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </section>
<? }
}
