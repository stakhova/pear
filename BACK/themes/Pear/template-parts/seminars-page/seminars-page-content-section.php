<?php

class Seminars_Page_Content_Section
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

        $this->seminar_type = get_terms(array(
            'taxonomy'   => 'seminar_type',
            'hide_empty' => false,
        ));

        $this->seminar_conducting_method = get_terms(array(
            'taxonomy'   => 'seminar_conducting_method',
            'hide_empty' => false,
        ));

        $this->queried_object = get_queried_object();

        if (!empty($this->queried_object->term_id)) {
            $this->current_link = get_category_link($this->queried_object->term_id);
        } else {
            $this->current_link = Page_Seminars::get_url();
        }

        $args = array(
            'post_type' => 'seminar',
            'posts_per_page' => 9999,
        );

        if (!empty($this->queried_object->slug)) {
            $args['tax_query'][] = array(
                array(
                    'taxonomy' => 'seminar_theme',
                    'field'    => 'slug',
                    'terms'    => array($this->queried_object->slug),
                    'operator' => 'IN',
                ),
            );
        }

        if (!empty($_GET['type'])) {
            $args['tax_query'][] = array(
                array(
                    'taxonomy' => 'seminar_type',
                    'field'    => 'slug',
                    'terms'    => array($_GET['type']),
                    'operator' => 'IN',
                ),
            );
        }

        if (!empty($_GET['method'])) {
            $args['tax_query'][] = array(
                array(
                    'taxonomy' => 'seminar_conducting_method',
                    'field'    => 'slug',
                    'terms'    => array($_GET['method']),
                    'operator' => 'IN',
                ),
            );
        } else {
            $args['tax_query'][] = array(
                array(
                    'taxonomy' => 'seminar_conducting_method',
                    'field'    => 'slug',
                    'terms'    => array($this->seminar_conducting_method[0]->slug),
                    'operator' => 'IN',
                ),
            );
        }

        $this->query = new WP_Query($args);
        wp_reset_postdata();
    }

    public function render()
    { ?>

        <section class="section seminar">
            <div class="container">

                <div class="seminar__filter">
                    <div class="seminar__topic choose">
                        <?php
                        $current_link = Page_Seminars::get_url();
                        if (!empty($_GET['type']) and !empty($_GET['method'])) {
                            $current_link .= '?type=' . $_GET['type'] . '&method=' . $_GET['method'];
                        } else {
                            if (!empty($_GET['type'])) {
                                $current_link .= '?type=' . $_GET['type'];
                            }
                            if (!empty($_GET['method'])) {
                                $current_link .= '?method=' . $_GET['method'];
                            }
                        }
                        ?>
                        <a href="<?php echo $current_link; ?>" class="topic__item <?php echo (Page_Seminars::get_ID() == get_the_ID()) ? 'active' : '' ?>">Alle Themen</a>
                        <?php foreach ($this->seminar_theme as $term) : ?>
                            <?php
                            $current_link = get_category_link($term->term_id);
                            if (!empty($_GET['type']) and !empty($_GET['method'])) {
                                $current_link .= '?type=' . $_GET['type'] . '&method=' . $_GET['method'];
                            } else {
                                if (!empty($_GET['type'])) {
                                    $current_link .= '?type=' . $_GET['type'];
                                }
                                if (!empty($_GET['method'])) {
                                    $current_link .= '?method=' . $_GET['method'];
                                }
                            }
                            ?>
                            <a href="<?php echo $current_link; ?>" class="topic__item <?php echo ($this->queried_object->term_id == $term->term_id) ? 'active' : '' ?>"><?php echo $term->name; ?></a>
                        <?php endforeach; ?>
                    </div>
                    <div class="seminar__filter-flex">
                        <div class="seminar__radio">
                            <div class="seminar__radio-item seminar__radio-three choose">
                                <?php if (empty($_GET['method'])) : ?>
                                    <a href="<?php echo $this->current_link; ?>" <?php echo (empty($_GET['type']) ? 'class="active"' : '') ?>>Alle Typen</a>
                                    <?php foreach ($this->seminar_type as $type) : ?>
                                        <a href="<?php echo $this->current_link . '?type=' . $type->slug; ?>" <?php echo ($_GET['type'] == $type->slug ? 'class="active"' : '') ?>><?php echo $type->name; ?></a>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <a href="<?php echo $this->current_link . '?method=' . $_GET['method']; ?>" <?php echo (empty($_GET['type']) ? 'class="active"' : '') ?>>Alle Typen</a>
                                    <?php foreach ($this->seminar_type as $type) : ?>
                                        <a href="<?php echo $this->current_link . '?type=' . $type->slug . '&method=' . $_GET['method']; ?>" <?php echo ($_GET['type'] == $type->slug ? 'class="active"' : '') ?>><?php echo $type->name; ?></a>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                            <div class="seminar__radio-item seminar__radio-two choose">
                                <?php if (empty($_GET['type'])) : ?>
                                    <?php foreach ($this->seminar_conducting_method as $key => $method) : ?>
                                        <?php if ($key == 0) : ?>
                                            <?php if (empty($_GET['method'])) : ?>
                                                <a href="<?php echo $this->current_link; ?>" class="active"><?php echo $method->name; ?></a>
                                            <?php else : ?>
                                                <a href="<?php echo $this->current_link; ?>" <?php echo ($_GET['method'] == $method->slug ? 'class="active"' : '') ?>><?php echo $method->name; ?></a>
                                            <?php endif;  ?>
                                        <?php else : ?>
                                            <a href="<?php echo $this->current_link . '?method=' . $method->slug; ?>" <?php echo ($_GET['method'] == $method->slug ? 'class="active"' : '') ?>><?php echo $method->name; ?></a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <?php foreach ($this->seminar_conducting_method as  $key => $method) : ?>
                                        <?php if ($key == 0) : ?>
                                            <?php if (empty($_GET['method'])) : ?>
                                                <a href="<?php echo $this->current_link . '?type=' . $_GET['type']; ?>" class="active"><?php echo $method->name; ?></a>
                                            <?php else : ?>
                                                <a href="<?php echo $this->current_link . '?type=' . $_GET['type']; ?>" <?php echo ($_GET['method'] == $method->slug ? 'class="active"' : '') ?>><?php echo $method->name; ?></a>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <a href="<?php echo $this->current_link . '?type=' . $_GET['type'] . '&method=' . $method->slug; ?>" <?php echo ($_GET['method'] == $method->slug ? 'class="active"' : '') ?>><?php echo $method->name; ?></a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <form class="section__search" action="<?php echo get_the_permalink(get_option('page_on_front')); ?>">
                            <input type="hidden" name="post_type" value="seminar">
                            <div class="section__search-input">
                                <input type="text" name="s" placeholder="Seminar suchen…">
                            </div>
                            <button><span>Suche</span></button>
                        </form>

                    </div>
                </div>
                
                    <div class="seminar__card">
                        <div class="card__list seminar__card-list ">
                            <?php if (!empty($this->queried_object->description)) : ?>
                                <a class="card__item firsc-card">
                                    <div class="card__hover">
                                        <div class="card__hover-content content">
                                            <h3><?php echo $this->queried_object->name; ?></h3>
                                            <?php echo $this->queried_object->description; ?>
                                        </div>
                                    </div>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($this->query->posts)) : ?>
                            <?php foreach ($this->query->posts as $post) : ?>
                                <?php if (has_term('exklusiv','seminar_type',$post->ID)) : ?>
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
                                        <?php //if (!empty(get_field('main_options',$post->ID)['short_description'])) : ?>
                                            <!-- <div class="card__hover">
                                                <div class="card__hover-content content">
                                                    <h3><?php echo get_the_title($post->ID); ?></h3>
                                                    <?php echo get_field('main_options',$post->ID)['short_description']; ?>
                                                </div>

                                            </div> -->
                                        <?php //endif; ?>
                                        </a>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                        </div>
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
                        <input type="hidden" name="action" value="seminars_request">
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
