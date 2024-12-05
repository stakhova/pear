<?php

class Text_Page_Banner_Section
{
    public function __construct() {}

    public function render()
    { ?>
        <section class="section__banner section__editor grey ">
            <div class="container">
                <h1 class="section__title "><?php echo get_the_title(); ?></h1>
            </div>
        </section>

<? }
}
