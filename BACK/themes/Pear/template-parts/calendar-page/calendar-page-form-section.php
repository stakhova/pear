<?php

class Calendar_Page_Form_Section
{
    public function __construct()
    {
        $section_seminars = get_field('section_seminars', Page_Seminars::get_ID());
        $this->form_title = $section_seminars['form_title'];
        $this->form_text = $section_seminars['form_text'];
        $this->policy_text = $section_seminars['policy_text'];

        $this->seminar_theme = get_terms(array(
            'taxonomy'   => 'seminar_theme',
            'hide_empty' => false,
        ));
    }

    public function render()
    { ?>

        <section class="section seminar">
            <div class="container">
                <div class="seminar__filter">
                    <div class="seminar__topic choose">
                        <a href="<?php echo get_the_permalink(Page_Calendar::get_ID()); ?>" class="topic__item <?php echo ((Page_Calendar::get_ID() and empty($_GET['theme'])) == get_the_ID()) ? 'active' : '' ?>">Alle Themen</a>
                        <?php foreach ($this->seminar_theme as $term) : ?>
                            <a href="<?php echo get_the_permalink(Page_Calendar::get_ID()) . '?theme=' . $term->slug; ?>" class="topic__item <?php echo ($_GET['theme'] == $term->slug) ? 'active' : '' ?>"><?php echo $term->name; ?></a>
                        <?php endforeach; ?>
                    </div>
                    <div class="seminar__filter-flex">
                        <form class="section__search" action="https://pear.blackbook.dev/">
                            <input type="hidden" name="post_type" value="seminar">
                            <div class="section__search-input">
                                <input type="text" name="s" placeholder="Seminar suchen…">
                            </div>
                            <button><span>Suche</span></button>
                        </form>

                    </div>
                </div>
                <div class="calendar">
                    <h2 class="section__middle calendar__section-title">
                        <?php if (empty($_GET['theme'])) : ?>
                            Alle Themen
                        <?php else : ?>
                            <?php $term = get_term_by('slug',$_GET['theme'],'seminar_theme')?>
                            <?php echo $term->name; ?>
                        <?php endif; ?>

                    </h2>
                    <div id="calendar"></div>

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
                            <button class="section__more-btn">Weniger Information</button>
                        </div>

                    </div>
                    <form action="" class="form form__seminar">
                        <input type="hidden" name="action" value="calendar_request">
                        <div class="form__input">
                            <label>voller Name</label>
                            <div class="form__input-wrap">
                                 <input type="text" name="name" placeholder="Max Mustermann">
                            </div>
                        </div>
                        <div class="form__input">
                            <label>E-Mail</label>
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
                            <label>Deine Anfrage</label>
                            <div class="form__input-wrap">
                                <textarea name="message" placeholder="Ich möchte..."></textarea>
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
