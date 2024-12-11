<?php

class Front_Page_Place_Section
{
    public function __construct() {}

    public function render()
    { ?>

        <section class="section grey place">

            <div class="place__back img">
                <img src="./img/bottom.png" alt="">
            </div>
            <div class="container">
                <div class="section__top">
                    <div class="section__top-left">
                        <p class="section__category">kommende seminare</p>
                        <h2 class="section__title"> Sichern Sie sich Ihren Platz</h2>
                    </div>
                    <div class="section__top-search">
                        <form class="section__search">
                            <input type="hidden" name="action" value="search">
                            <div class="section__search-input">
                                <input type="text" name="search" placeholder="Seminar suchen…">
                            </div>
                            <button><span>Suche</span></button>
                        </form>
                        <a href="" class="section__button primary">Kalender</a>
                    </div>
                </div>
                <div class="card__block">
                    <div class="swiper card__slider">
                        <div class="card__list swiper-wrapper">
                            <a href="" class="card__item green swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                    <span class="card__flag left"> in Kürze</span>
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
                            <a href="" class="card__item swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                    <span class="card__flag left"> in Kürze</span>
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
                            <a href="" class="card__item swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                    <span class="card__flag left"> in Kürze</span>
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
                            <a href="" class="card__item swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                    <span class="card__flag left"> in Kürze</span>
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
                            <a href="" class="card__item swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                    <span class="card__flag left"> in Kürze</span>
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
                            <a href="" class="card__item swiper-slide">
                                <div class="card__img img">
                                    <img src="./img/card1.png" alt="">
                                    <span class="card__flag right"> Noch 11 Tage</span>
                                    <span class="card__flag left"> in Kürze</span>
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
                <div class="section__form">
                    <div class="section__form-info">
                        <div class="section__more">
                            <div class="section__form-content content">
                                <h3>Sie haben nicht das richtige Thema oder Datum gefunden - Kontaktieren Sie uns für
                                    ein Inhouse Seminar</h3>
                                <p>Jedes unserer Seminare können Sie auch direkt bei Ihnen im Unternehmen buchen –
                                    maßgeschneidert und perfekt auf Ihre Bedürfnisse abgestimmt. Der größte Vorteil: Wir
                                    passen die Inhalte im Vorfeld exakt an Ihre Unternehmensanforderungen an, sodass Sie
                                    nicht nur Standardwissen, sondern Lösungen erhalten, die für Ihr Geschäft relevant
                                    sind.</p>
                                <p>Mit unseren Inhouse-Seminaren sparen Sie sich Anfahrtswege und Schulungsräume – wir
                                    kommen zu Ihnen! Dadurch können Ihre Mitarbeiter in ihrer gewohnten Umgebung gezielt
                                    weitergebildet werden, mit Inhalten, die individuell auf Ihre Branche, Abläufe und
                                    Herausforderungen zugeschnitten sind. So stellen wir sicher, dass das Gelernte
                                    sofort in die Praxis umgesetzt werden kann.</p>
                                <p>Maximale Flexibilität, maßgeschneiderte Inhalte und direkter Praxisbezug – machen Sie
                                    den nächsten Schritt und buchen Sie Ihr Inhouse-Seminar noch heute!</p>
                                <p>Maximale Flexibilität, maßgeschneiderte Inhalte und direkter Praxisbezug – machen Sie
                                    den nächsten Schritt und buchen Sie Ihr Inhouse-Seminar noch heute!</p>
                                <p>Maximale Flexibilität, maßgeschneiderte Inhalte und direkter Praxisbezug – machen Sie
                                    den nächsten Schritt und buchen Sie Ihr Inhouse-Seminar noch heute!</p>
                            </div>
                            <button class="section__more-btn">Mehr Information</button>
                        </div>

                    </div>
                    <form action="" class="form form__seminar">
                        <input type="hidden" name="action" value="seminar">
                        <div class="form__input">
                            <label>voller Name</label>
                            <input type="text" name="name" placeholder="Max Mustermann">
                        </div>
                        <div class="form__input">
                            <label>E-Mail</label>
                            <input type="text" name="email" placeholder="example@mail.com">
                        </div>
                        <div class="form__input">
                            <label>Telefonnummer</label>
                            <input type="text" name="phone" placeholder="+49 XXX XXXXXXXX">
                        </div>
                        <div class="form__input textarea">
                            <label>Deine Anfrage</label>
                            <textarea name="message" placeholder="Ich möchte..."></textarea>
                        </div>
                        <div class="form__checkbox">
                            <input type="checkbox" id="check" name="policy_terms">
                            <label for="check">Ich habe die <a href="">Datenschutzerklärung </a> gelesen und stimme der
                                Verarbeitung meiner Daten zur Kontaktaufnahme und Bearbeitung meiner Anfrage zu.</label>
                        </div>
                        <button class="section__button primary">Senden</button>
                    </form>
                </div>

            </div>
        </section>
<? }
}
