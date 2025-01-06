<?php

class Campus_Page_Form_Section
{
    public function __construct() {
        $section_content = get_field('section_content');
        $this->form_title = $section_content['form_title'];
        $this->form_text = $section_content['form_text'];
        $this->form_email = $section_content['form_email'];
        $this->person_image = $section_content['person_image'];
        $this->person_name = $section_content['person_name'];
        $this->person_position = $section_content['person_position'];
    }

    public function render()
    { ?>

        <section class="section  campus__form ">
            <div class="campus__form-back img">
                <img src="<?=TEMPLATE_PATH?>/img/campus-top.png" alt="">
            </div>
            <div class="container">
                <div class="section__form">
                    <div class="section__form-info">
                        <?php if (!empty($this->form_title)) : ?>
                            <h3 class="campus__form-title"><?php echo $this->form_title; ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($this->form_text)) : ?>
                            <p class="section__text"><?php echo $this->form_text; ?></p>
                        <?php endif; ?>
                        <?php if (!empty($this->form_email)) : ?>
                            <div class="campus__form-email">
                                <span>E-Mail</span>
                                <a href="mailto:vmunteanu@pear-academy.de"><?php echo $this->form_email; ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="campus__form-person">
                            <?php if (!empty($this->person_image)) : ?>
                                <div class="img">
                                    <img src="<?php echo $this->person_image; ?>" alt="">
                                </div>
                            <?php endif; ?>
                            
                            <div class="campus__form-person-info">
                                <?php if (!empty($this->person_name)) : ?>
                                    <h4><?php echo $this->person_name; ?></h4>
                                <?php endif; ?>
                                <?php if (!empty($this->person_position)) : ?>
                                    <p class="section__text"><?php echo $this->person_position; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    <form action="" class="form form__seminar" novalidate="novalidate">
                        <input type="hidden" name="action" value="campus_request">
                        <div class="form__input">
                            <label>voller Name</label>
                            <div class="form__input-wrap">
                                <input type="text" name="name" placeholder="Max Mustermann">
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
                                <input type="text" name="email" placeholder="example@mail.com">
                            </div>
                        </div>
                        <div class="form__input textarea">
                            <label>Deine Anfrage</label>
                            <div class="form__input-wrap">
                                <textarea name="message" placeholder="Ich möchte..."></textarea>
                            </div>
                        </div>
                        <div class="form__checkbox">
                            <input type="checkbox" id="check" name="policy_terms">
                            <label for="check">Ich habe die <a href="">Datenschutzerklärung </a> gelesen und stimme der Verarbeitung meiner Daten zur Kontaktaufnahme und Bearbeitung meiner Anfrage zu.</label>
                        </div>
                        <button class="section__button primary">Senden</button>
                    </form>
                </div>

            </div>


        </section>
<? }
}
