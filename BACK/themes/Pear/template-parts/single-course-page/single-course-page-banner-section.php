<?php

class Single_Course_Page_Banner_Section
{
    public function __construct() {
        $main_options = get_field('main_options');
        $this->reviews_count = $main_options['reviews_count'];
        $this->certificate = $main_options['certificate'];
        $this->price = $main_options['price'];
        $this->description = $main_options['description'];

        $this->price_text = get_field('additional_texts',Page_Option::get_ID())['price_text'];
    }

    public function render()
    { ?>

        <section class="section__banner section__banner-seminar grey">
            <div class="container">
                <div class="section__banner-flex">
                    <div class="section__banner-info">
                        <div class="banner__tag">
                            <?php if (!empty($this->reviews_count)) : ?>
                                <div class="banner__tag-item review">
                                    <span>(<?php echo $this->reviews_count; ?>)</span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($this->certificate)) : ?>
                                <div class="banner__tag-item white">
                                    <span><?php echo $this->certificate; ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <h1 class="section__middle"><?php echo get_the_title(); ?></h1>
                        <?php if (!empty($this->description)) : ?>
<!--                            <div class="registration__flex">-->
                                <p class="section__text"><?php echo $this->description; ?></p>
<!--                            </div>-->
                        <?php endif; ?>
                        <div class="section__banner-seminar-button">
                            <a href="#form" class="section__button primary">Registrieren</a>
                            <div class="price__wrap"><span> <?php echo $this->price; ?> Euro    </span> <?php if (!empty($this->price_text)) : ?>
                                <p><?php echo $this->price_text; ?></p>
                                <?php endif; ?></div>
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
