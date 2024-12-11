<?php

class Front_Page_Exclusive_Section
{
    public function __construct() {}

    public function render()
    { ?>

        <section class="section exclusive  ">
            <div class="container">
                <div class="section__top">
                    <div class="section__top-left">
                        <h2 class="section__title"> Exclusive Seminare </h2>
                        <div class="section__more">
                            <div class="section__form-content content ">
                                <p>Unsere exklusiven Seminare bieten Ihnen die einzigartige Möglichkeit, in einer
                                    kleinen Runde von maximal drei Teilnehmern individuell betreut zu werden. In dieser
                                    intensiven Lernumgebung gehen wir gezielt auf Ihre speziellen Fragestellungen ein
                                    und entwickeln maßgeschneiderte Lösungen. Sie profitieren von direktem Austausch,
                                    praxisnahen Beispielen und persönlichen Empfehlungen.</p>
                                <p>In einem exklusiven Seminar erhalten Sie die volle Aufmerksamkeit unserer Experten.
                                    Dies ermöglicht es uns, tiefer in Ihre spezifischen Themen einzutauchen und
                                    individuelle Strategien zu erarbeiten, die Sie sofort in Ihrem Unternehmen umsetzen
                                    können. Exklusive Seminare bieten den Vorteil, dass wir Ihre Zeit effizient nutzen,
                                    um Ihnen den größtmöglichen Mehrwert zu bieten.</p>
                                <p>Wenn Sie ein Seminar exklusiv buchen möchten, das nicht entsprechend gekennzeichnet
                                    ist, sprechen Sie uns gerne an.</p>
                                <p>Wenn Sie ein Seminar exklusiv buchen möchten, das nicht entsprechend gekennzeichnet
                                    ist, sprechen Sie uns gerne an.</p>

                            </div>
                            <button class="section__more-btn">Mehr Information</button>
                        </div>
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
                            <a href="" class="card__item yellow swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                </div>
                                <div class="card__info">
                                    <div class="card__date">
                                        <span>03 OKT. 24</span>
                                        <span class="card__date-loc">Bamberg</span>
                                    </div>
                                    <h3 class="card__title"> Seminar: QSV - Risk minimization and liability distribution
                                    </h3>
                                </div>
                            </a>
                            <a href="" class="card__item yellow swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                </div>
                                <div class="card__info">
                                    <div class="card__date ">
                                        <span>03 OKT. 24</span>
                                        <span class="card__date-loc online">online</span>
                                    </div>
                                    <h3 class="card__title"> Seminar: QSV - Risk minimization and liability distribution
                                    </h3>
                                </div>
                            </a>
                            <a href="" class="card__item yellow swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                </div>
                                <div class="card__info">
                                    <div class="card__date ">
                                        <span>03 OKT. 24</span>
                                        <span class="card__date-loc online">online</span>
                                    </div>
                                    <h3 class="card__title"> Seminar: QSV - Risk minimization and liability distribution
                                    </h3>
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
