<?php

class Front_Page_Competence_Section
{
    public function __construct() {}

    public function render()
    { ?>

        <section class="section competence">
            <div class="container">
                <div class="section__center">
                    <h2 class="section__title"> Unsere Kompetenz</h2>
                    <p class="section__text">Wir sind ein engagiertes Team, das Bildung als Schlüssel zum Erfolg sieht
                        und Seminare gestaltet, die informieren und inspirieren – mit Fachwissen und einem offenen Ohr
                        für Ihre Bedürfnisse.</p>
                </div>
                <div class="card__block">
                    <div class="swiper card__slider">
                        <div class="card__list swiper-wrapper">
                            <div class="card__item competence__item swiper-slide">
                                <div class="card__img">
                                    <div class="competence__img img">
                                        <img src="./img/u1.svg" alt="">
                                    </div>
                                </div>
                                <div class="card__info">
                                    <h3 class="card__title">Energiemanagement</h3>
                                    <p class="card__text">Wir nutzen modernste Technologien und interaktive Methoden, um
                                        Teilnehmer aktiv einzubinden und das Lernen zu fördern.</p>
                                </div>
                            </div>
                            <div class="card__item competence__item swiper-slide">
                                <div class="card__img">
                                    <div class="competence__img img">
                                        <img src="./img/u2.svg" alt="">
                                    </div>
                                </div>
                                <div class="card__info">
                                    <h3 class="card__title">Maßgeschneiderte Seminare</h3>
                                    <p class="card__text">Wir nutzen modernste Technologien und interaktive Methoden, um
                                        Teilnehmer aktiv einzubinden und das Lernen zu fördern.</p>
                                </div>
                            </div>
                            <div class="card__item competence__item swiper-slide">
                                <div class="card__img">
                                    <div class="competence__img img">
                                        <img src="./img/u3.svg" alt="">
                                    </div>
                                </div>
                                <div class="card__info">
                                    <h3 class="card__title">Anerkannte Kompetenz</h3>
                                    <p class="card__text">Wir nutzen modernste Technologien und interaktive Methoden, um
                                        Teilnehmer aktiv einzubinden und das Lernen zu fördern.</p>
                                </div>
                            </div>
                            <div class="card__item competence__item swiper-slide">
                                <div class="card__img">
                                    <div class="competence__img img">
                                        <img src="./img/u4.svg" alt="">
                                    </div>
                                </div>
                                <div class="card__info">
                                    <h3 class="card__title">Ausbildung für Auditoren</h3>
                                    <p class="card__text">Wir nutzen modernste Technologien und interaktive Methoden, um
                                        Teilnehmer aktiv einzubinden und das Lernen zu fördern.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card__nav">
                        <button class="swiper-button-prev card__prev"></button>
                        <button class="swiper-button-next card__next"></button>
                    </div>
                </div>
            </div>

        </section>
<? }
}
