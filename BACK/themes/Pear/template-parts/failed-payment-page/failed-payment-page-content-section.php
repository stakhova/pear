<?php

class Failed_Payment_Page_Content_Section
{
    public function __construct() {}

    public function render()
    { ?>

        <section class="section__white">
            <div class="container">
                <div class="section__white-block">
                    <div class="section__white-icon error img">
                        <img src="./img/error.svg" alt="">
                    </div>
                    <h1 class="section__title">Zahlung fehlgeschlagen</h1>
                    <p class="section__white-text">Etwas ist schief gelaufen, überprüfen Sie Ihre Zahlungsmethode und
                        versuchen Sie es erneut. Wenn der Fehler weiterhin auftritt, kontaktieren Sie uns bitte.</p>
                    <div class="banner__button">
                        <a href="" class="section__button primary">Zurück zur Registrierung</a>
                        <a href="" class="section__button grey ">Kalender</a>
                    </div>
                </div>
            </div>
        </section>
<? }
}
