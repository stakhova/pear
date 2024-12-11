<?php

class Front_Page_Banner_Section
{
    public function __construct() {}

    public function render()
    { ?>

        <section class="banner">
            <div class="banner__img img">
                <img src="./img/banner.png" alt="">
            </div>
            <div class="container">
                <div class="banner__flex section__flex">
                    <div class="banner__info">
                        <h1 class="section__title white">Wir bringen Ihre Expertise auf das nächste Level </h1>
                        <h3 class="banner__subtitle">Maßgeschneiderte, praxisorientierte Seminarefür Ihren Erfolg</h3>
                        <div class="banner__button">
                            <a href="" class="section__button primary">Kalender</a>
                            <a href="" class="section__button ">Seminare</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
<? }
}
