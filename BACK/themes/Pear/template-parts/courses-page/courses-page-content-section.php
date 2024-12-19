<?php

class Courses_Page_Content_Section
{
    public function __construct() {
        $this->terms = get_terms( array(
            'taxonomy'   => 'course_type',
            'hide_empty' => false,
        ) );
        $this->queried_object = get_queried_object();

        $args = array(
            'post_type' => 'course',
            'posts_per_page' => 9999,
        );

        if (!empty($this->queried_object->slug)) {
            $args['tax_query'] =array(
                array(
                    'taxonomy' => 'course_type',
                    'field'    => 'slug',
                    'terms'    => array($this->queried_object->slug),
                    'operator' => 'IN',
                ),
            );
        }
        
        $this->query = new WP_Query($args);
    }

    public function render()
    { ?>

        <section class="section seminar">
            <div class="container">
                <div class="seminar__filter">
                    <div class="seminar__topic choose">
                        <a href="<?php echo Page_Courses::get_url(); ?>" class="topic__item <?php echo (Page_Courses::get_ID() == get_the_ID()) ? 'active' : ''?>">Alle Themen</a>
                        <?php foreach ($this->terms as $term) : ?>
                            <a href="<?php echo get_category_link($term->term_id); ?>" class="topic__item <?php echo ($this->queried_object->term_id == $term->term_id) ? 'active' : ''?>"><?php echo $term->name; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="card__block seminar__card">
                    <?php if (!empty($this->query->posts)) : ?>
                        <div class="card__list ">
                            <?php foreach ($this->query->posts as $post) : ?>
                                <a href="<?php echo get_the_permalink($post->ID)?>" class="card__item grey">
                                    <div class="card__img img">
                                        <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="">
                                    </div>
                                    <div class="card__info">
                                        <div class="card__info-top">
                                            <?php if (!empty(get_field('main_options',$post->ID)['certificate'])) : ?>
                                                <span class="card__iso"><?php echo get_field('main_options',$post->ID)['certificate']; ?></span>
                                            <?php endif; ?>
                                            <?php if (!empty(get_field('main_options',$post->ID)['reviews_count'])) : ?>
                                                <div class="card__star" data-star="5"><span>(<?php echo get_field('main_options',$post->ID)['reviews_count']; ?>)</span></div>
                                            <?php endif; ?>
                                        </div>
                                        <h3 class="card__title"><?php echo get_the_title($post->ID); ?></h3>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>


            </div>


        </section>
<? }
}
