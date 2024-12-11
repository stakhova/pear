<?php

class Front_Page_Promise_Section
{
    public function __construct() {}

    public function render()
    { ?>

        <section class="section promise">

            <div class="container">
                <div class="promise__block section__flex">
                    <div class="promise__img img">
                        <img src="./img/promise.png" alt="">
                    </div>
                    <div class="promise__info">
                        <div class="promise__back img">
                            <img src="./img/top.png" alt="">
                        </div>
                        <p class="section__category">Unser Versprechen</p>
                        <h2 class="promise__title">Unsere hochqualifizierten, erfahrenen Referenten vermitteln komplexe
                            Themen verständlich mit klarem Fokus auf die praktische Umsetzung</h2>
                        <div class="section__flex promise__count-wrap">
                            <div class="promise__count">
                                <h4><span class="counter" data-target="120">0</span>+</h4>
                                <p class="section__text">Erfolgreiche Seminareund Schulungen</p>
                            </div>
                            <div class="promise__count">
                                <h4><span class="counter" data-target="300">0</span>+</h4>
                                <p class="section__text">Zufriedene Kunden</p>
                            </div>
                            <div class="promise__count">
                                <h4><span class="counter" data-target="35">0</span>+</h4>
                                <p class="section__text">Expert lecturers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<? }
}
