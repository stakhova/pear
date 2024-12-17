<?php

class Single_Seminar_Page_Bottom_Section
{
    public function __construct()
    {
        $section_seminars = get_field('section_seminars', Page_Seminars::get_ID());
        $this->form_title = $section_seminars['form_title'];
        $this->form_text = $section_seminars['form_text'];
        $this->policy_text = $section_seminars['policy_text'];
    }

    public function render()
    { ?>

        <section class="section seminar__form-bottom">
            <div class="container">
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
                            <button class="section__more-btn">Weniger Information</button>
                        </div>

                    </div>
                    <form action="" class="form form__seminar">
                        <input type="hidden" name="action" value="seminars_request">
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
                            <input type="checkbox" id="check1" name="policy_terms">
                            <label for="check1"><?php echo str_replace(['<p>', '</p>'], ['', ''], $this->policy_text); ?></label>
                        </div>
                        <button class="section__button primary">Senden</button>
                    </form>
                </div>
            </div>
        </section>
<? }
}
