<?php

class Search_Page_Search_Section
{
    public function __construct() {
        $post_type = $_GET['post_type'];
        $type = $_GET['exklusiv'];

        $args = array(
            'post_type' => $post_type ?? ['seminar','course'],
            'posts_per_page' => 100,
            's' => $_GET['s']
        );

        if (($post_type == 'service') and !empty($type)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'seminar_type',
                    'field'    => 'slug',
                    'terms'    => array($type),
                    'operator' => 'IN',
                )
            );
        } 
        $this->query = new WP_Query($args);
    }

    public function render()
    { ?>
        <section class="search section">
            <div class="container">
                <div class="search__block">
                    <form class="search__form">
                        <input type="hidden" name="post_type" value="<?php echo $_GET['post_type']; ?>">
                        <div class="search__form-input">
                            <input type="text" name="s"  placeholder="Suche auf der Website..." value="<?php echo $_GET['s']; ?>">
                        </div>

                    </form>
                    <div class="search__list">
                        <?php if (!empty($this->query->posts)) : ?>
                        <?php foreach ($this->query->posts as $post) : ?>
                            <a href="<?php echo get_the_permalink($post->ID); ?>" class="search__item">
                                <p><?php echo ucfirst(get_post_type($post->ID));?></p>
                                <h3><?php echo get_the_title($post->ID); ?></h3>
                            </a>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <p>Nichts gefunden</p>
                        <?php endif; ?>
                    </div>
                </div>


            </div>

        </section>

<? }
}
