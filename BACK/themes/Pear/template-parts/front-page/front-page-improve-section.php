<?php

class Front_Page_Improve_Section
{
    public function __construct() {}

    public function render()
    { ?>

        <section class="section improve">
            <div class="container">
                <div class="section__top">
                    <div class="section__top-left">
                        <h2 class="section__title"> Weiterbildungen <br> für Auditoren</h2>
                        <p class="section__text">Auditoren müssen regelmäßig Weiterbildungen absolvieren – buchen Sie
                            noch heute Ihren flexiblen Kurs im Selbststudium und bleiben Sie zertifiziert!</p>
                    </div>

                    <div class="section__top-search">
                        <form class="section__search">
                            <input type="hidden" name="action" value="search">
                            <div class="section__search-input">
                                <input type="text" name="search" placeholder="Seminar suchen…">
                            </div>
                            <button><span>Suche</span></button>
                        </form>
                        <a href="" class="section__button primary">Alle Exclusiven</a>
                    </div>
                </div>
                <div class="card__block">
                    <div class="swiper card__slider">
                        <div class="card__list swiper-wrapper">
                            <a href="" class="card__item grey swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/banner.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                </div>
                                <div class="card__info">
                                    <div class="card__info-top">
                                        <span class="card__iso">ISO 50001</span>
                                        <div class="card__star" data-star="5"><span>(23)</span></div>
                                    </div>
                                    <h3 class="card__title">Energiemanagement</h3>
                                </div>
                            </a>
                            <a href="" class="card__item grey swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                </div>
                                <div class="card__info">
                                    <div class="card__info-top">
                                        <span class="card__iso">ISO 50001</span>
                                        <div class="card__star" data-star="3"><span>(23)</span></div>
                                    </div>
                                    <h3 class="card__title">Energiemanagement</h3>
                                </div>
                            </a>
                            <a href="" class="card__item grey swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                </div>
                                <div class="card__info">
                                    <div class="card__info-top">
                                        <span class="card__iso">ISO 50001</span>
                                        <div class="card__star" data-star="4"><span>(23)</span></div>
                                    </div>
                                    <h3 class="card__title">Energiemanagement</h3>
                                </div>
                            </a>
                            <a href="" class="card__item grey swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                </div>
                                <div class="card__info">
                                    <div class="card__info-top">
                                        <span class="card__iso">ISO 50001</span>
                                        <div class="card__star" data-star="5"><span>(23)</span></div>
                                    </div>
                                    <h3 class="card__title">Energiemanagement</h3>
                                </div>
                            </a>
                            <a href="" class="card__item grey swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                </div>
                                <div class="card__info">
                                    <div class="card__info-top">
                                        <span class="card__iso">ISO 50001</span>
                                        <div class="card__star" data-star="1"><span>(23)</span></div>
                                    </div>
                                    <h3 class="card__title">Energiemanagement</h3>
                                </div>
                            </a>
                            <a href="" class="card__item grey swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                </div>
                                <div class="card__info">
                                    <div class="card__info-top">
                                        <span class="card__iso">ISO 50001</span>
                                        <div class="card__star" data-star="3"><span>(23)</span></div>
                                    </div>
                                    <h3 class="card__title">Energiemanagement</h3>
                                </div>
                            </a>

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
