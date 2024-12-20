<?php

class Single_Course_Page_Form_Section
{
    public function __construct() {
        $main_options = get_field('main_options');
        $this->form_policy_text = $main_options['form_policy_text'];
        $this->theme = $main_options['theme'];
        $this->price = $main_options['price'];
        $this->certificate = $main_options['certificate'];
        $this->term = wp_get_post_terms(get_the_ID(),'course_type')[0]->name ?? '';
    }

    public function render()
    { ?>

        <section class="section" id="form">
            <div class="container">
                <div class="section__form grey registration">
                    <div class="section__form-info">
                        <h3 class="section__form-title">Anmeldung zum Kurs</h3>
                        <div class="registration__list">
                            <?php if (!empty($this->theme)) : ?>
                                <div class="registration__item">
                                    <span class="registration__item-title">Thema</span>
                                    <p class="registration__item-text"><?php echo $this->theme; ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($this->term)) : ?>
                                <div class="registration__item">
                                    <span class="registration__item-title">Kategorie</span>
                                    <p class="registration__item-text"><?php echo $this->term; ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($this->certificate)) : ?>
                                <div class="registration__item">
                                    <span class="registration__item-title">ISO</span>
                                    <p class="registration__item-text"><?php echo $this->certificate; ?></p>
                                </div>
                            <?php endif; ?>
                        </div>


                    </div>
                    <form action="" class="form form__seminar-full">
                        <input type="hidden" name="action" value="course_request">
                        <input type="hidden" name="course_name" value="<?php echo get_the_title(); ?>">
                        <input type="hidden" name="course_id" value="<?php echo get_the_ID(); ?>">
                        <!-- <input type="hidden" name="count" value="1"> -->
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
                        <?php if (!empty($this->form_policy_text)) : ?>
                            <div class="form__checkbox">
                                <input type="checkbox" id="check" name="policy_terms">
                                <label for="check"><?php echo str_replace(['<p>','</p>'],['',''],$this->form_policy_text); ?></label>
                            </div>
                        <?php endif; ?>
                        <div class="form__button">
                            <button class="section__button primary " data-price="<?php echo $this->price; ?>">
                                <p>Platz sichern</p>
                                <div class="price"><span><?php echo $this->price; ?></span> Euro</div>
                            </button>
                            <!-- <div class="form__button-counter">
                                <div class="form__button-count form__button-count-minus"></div>
                                <span>1</span>
                                <div class="form__button-count form__button-count-plus"></div>
                            </div> -->

                        </div>
                    </form>
                </div>
            </div>
        </section>
<? }
}
