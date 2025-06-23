<?php

class Search_Page_Search_Section
{
    public function __construct()
    {
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

        $this->course_type = get_terms(array(
            'taxonomy'   => 'course_type',
            'hide_empty' => false,
        ));

        $post_type = $_GET['post_type'] ? $_GET['post_type'] : ['seminar', 'course'];

        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => 100,
            's' => $_GET['s']
        );

        if (($post_type == 'seminar')) {
            if (!empty($_GET['seminars_type'])) {
                $args['tax_query'][] = array(
                    array(
                        'taxonomy' => 'seminar_type',
                        'field'    => 'slug',
                        'terms'    => array($_GET['seminars_type']),
                        'operator' => 'IN',
                    ),
                );
            }

            if (!empty($_GET['seminars_theme'])) {
                $args['tax_query'][] = array(
                    array(
                        'taxonomy' => 'seminar_theme',
                        'field'    => 'slug',
                        'terms'    => array($_GET['seminars_theme']),
                        'operator' => 'IN',
                    ),
                );
            }

            if (!empty($_GET['seminars_method'])) {
                $args['tax_query'][] = array(
                    array(
                        'taxonomy' => 'seminar_conducting_method',
                        'field'    => 'slug',
                        'terms'    => array($_GET['seminars_method']),
                        'operator' => 'IN',
                    ),
                );
            }
        }

        if (($post_type == 'course')) {
            if (!empty($_GET['courses_theme'])) {
                $args['tax_query'][] = array(
                    array(
                        'taxonomy' => 'course_type',
                        'field'    => 'slug',
                        'terms'    => array($_GET['courses_theme']),
                        'operator' => 'IN',
                    ),
                );
            }
        }

        $this->query = new WP_Query($args);
    }

    public function render()
    { ?>
        <section class="search section">
            <div class="container">
                <div class="search__block">
                    <div class="search__block-filter">
                        <div class="search__block-top">
                            <div class="seminar__radio">
                                <div class="seminar__radio-item seminar__radio-three choose">
                                    <a href="<?php echo $this->current_link . '?s=' . $_GET['s']; ?>" <?php echo (empty($_GET['post_type']) ? 'class="active"' : '') ?>>Alles</a>
                                    <a href="<?php echo $this->current_link . '?post_type=seminar&s=' . $_GET['s']; ?>" <?php echo ($_GET['post_type'] == 'seminar' ? 'class="active"' : '') ?>>Seminare</a>
                                    <a href="<?php echo $this->current_link . '?post_type=course&s=' . $_GET['s']; ?>" <?php echo ($_GET['post_type'] == 'course' ? 'class="active"' : '') ?>>Auditoren</a>
                                </div>
                            </div>

                            <form class="search__form">
                                <input type="hidden" name="post_type" value="<?php echo $_GET['post_type']; ?>">
                                <div class="search__form-input">
                                    <input type="text" name="s" placeholder="Suche auf der Website..." value="<?php echo $_GET['s']; ?>">
                                </div>

                            </form>
                        </div>
                        <?php
                        // Функція для додавання параметрів до URL
                        function add_query_params($base_url, $params)
                        {
                            $query_separator = strpos($base_url, '?') === false ? '?' : '&';
                            return $base_url . $query_separator . http_build_query($params);
                        }

                        if ($_GET['post_type'] == 'seminar') : ?>
                            <div class="seminar__radio">
                                <!-- Типи семінарів -->
                                <div class="seminar__radio-item seminar__radio-three choose">
                                    <?php
                                    $base_params = ['s' => $_GET['s'], 'post_type' => $_GET['post_type']];
                                    $seminars_method = $_GET['seminars_method'] ?? null;
                                    $seminars_type = $_GET['seminars_type'] ?? null;
                                    ?>
                                    <a href="<?php echo add_query_params($this->current_link, $base_params); ?>"
                                        class="<?php echo (empty($seminars_type)) ? 'active' : ''; ?>">Alle Typen</a>
                                    <?php foreach ($this->seminar_type as $type) :
                                        $params = array_merge($base_params, ['seminars_type' => $type->slug]);
                                        if (!empty($seminars_method)) {
                                            $params['seminars_method'] = $seminars_method;
                                        }
                                    ?>
                                        <a href="<?php echo add_query_params($this->current_link, $params); ?>"
                                            class="<?php echo ($seminars_type == $type->slug) ? 'active' : ''; ?>">
                                            <?php echo $type->name; ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Методи проведення -->
                                <div class="seminar__radio-item seminar__radio-two choose">
                                    <?php
                                    $base_params = ['s' => $_GET['s'], 'post_type' => $_GET['post_type']];
                                    $seminars_method = $_GET['seminars_method'] ?? null;
                                    $seminars_type = $_GET['seminars_type'] ?? null;
                                    ?>
                                    <a href="<?php echo add_query_params($this->current_link, $base_params); ?>"
                                        class="<?php echo (empty($seminars_method)) ? 'active' : ''; ?>">Alle Formate</a>
                                    <?php foreach ($this->seminar_conducting_method as $key => $method) :
                                        $params = array_merge($base_params, ['seminars_method' => $method->slug]);

                                        if (!empty($seminars_type)) {
                                            $params['seminars_type'] = $seminars_type;
                                        }

                                    ?>
                                        <a href="<?php echo add_query_params($this->current_link, $params); ?>"
                                            class="<?php echo ($_GET['seminars_method'] == $method->slug ) ? 'active' : ''; ?>">
                                            <?php echo $method->name; ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Тематика семінарів -->
                                <div class="seminar__topic choose">
                                    <?php
                                    $base_theme_params = $base_params;
                                    if (!empty($seminars_type)) {
                                        $base_theme_params['seminars_type'] = $seminars_type;
                                    }
                                    if (!empty($seminars_method)) {
                                        $base_theme_params['seminars_method'] = $seminars_method;
                                    }
                                    ?>
                                    <a href="<?php echo add_query_params($this->current_link, $base_theme_params); ?>"
                                        class="<?php echo empty($_GET['seminars_theme']) ? 'active' : ''; ?>">Alle Themen</a>
                                    <?php foreach ($this->seminar_theme as $theme) :
                                        $params = array_merge($base_theme_params, ['seminars_theme' => $theme->slug]);
                                    ?>
                                        <a href="<?php echo add_query_params($this->current_link, $params); ?>"
                                            class="<?php echo ($_GET['seminars_theme'] == $theme->slug) ? 'active' : ''; ?>">
                                            <?php echo $theme->name; ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>



                        <?php if ($_GET['post_type'] == 'course') : ?>
                            <div class="seminar__radio">
                                <div class="seminar__topic choose">
                                    <a href="<?php echo $this->current_link . '&s=' . $_GET['s'] . '&post_type=' . $_GET['post_type']; ?>" <?php echo (empty($_GET['courses_theme']) ? 'class="active"' : '') ?>>Alle Typen</a>
                                    <?php foreach ($this->course_type as $type) : ?>
                                        <a href="<?php echo $this->current_link . '?courses_theme=' . $type->slug . '&s=' . $_GET['s'] . '&post_type=' . $_GET['post_type']; ?>" <?php echo ($_GET['courses_theme'] == $type->slug ? 'class="active"' : '') ?>><?php echo $type->name; ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>



                    <div class="search__list">
                        <?php if (!empty($this->query->posts)) : ?>
                            <?php foreach ($this->query->posts as $post) : ?>
                                <a href="<?php echo get_the_permalink($post->ID); ?>" class="search__item">
                                    <?php if (get_post_type($post->ID) == 'course') : ?>
                                        <p>Auditorenfortbildung</p>
                                    <?php else : ?>
                                        <p><?php echo ucfirst(get_post_type($post->ID)); ?></p>
                                    <?php endif; ?>
                                    <h3><?php echo get_the_title($post->ID); ?></h3>
                                </a>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="search__list-empty">Nichts gefunden</p>
                        <?php endif; ?>
                    </div>
                </div>


            </div>

        </section>

<? }
}
