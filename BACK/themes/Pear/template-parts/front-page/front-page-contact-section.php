<?php

class Front_Page_Contact_Section
{
    public function __construct() {}

    public function render()
    { ?>

        <section class="section contact">
            <div class="container">
                <div class="section__flex contact__flex">
                    <div class="contact__info">
                        <h2 class="contact__title">Kontakt</h2>
                        <div class="contact__list">
                            <div class="contact__item">
                                <span>Standort</span>
                                <a class="section__subtitle"
                                    href="https://maps.app.goo.gl/roeum5czKPbspdAE8">Edelfrauengrab 33
                                    <br> 77883 Ottenhöfen im Schwarzwald</a>
                            </div>
                            <div class="contact__item">
                                <span>Rufnummer</span>
                                <a class="section__subtitle" href="tel:+49017683342260">+49 (0)176 83342260 </a>
                            </div>
                            <div class="contact__item">
                                <span>E-Mail</span>
                                <a class="section__subtitle"
                                    href="mailto:jmhecker@pear-academy.de">jmhecker@pear-academy.de</a>
                            </div>
                        </div>

                    </div>
                    <div class="contact__map">
                        <div class="map__item" id="map"></div>

                        <script>
                            let mapIcon = '<?=TEMPLATE_PATH?>/img/map-loc.svg';

                            let positionMaps = {
                                lat: 32.051586,
                                lng: 34.768923,
                                text: '<p>Eexplore on google maps</p>'
                            }
                            console.log(positionMaps);
                            (g => {
                                var h, a, k, p = "The Google Maps JavaScript API",
                                    c = "google",
                                    l = "importLibrary",
                                    q = "__ib__",
                                    m = document,
                                    b = window;
                                b = b[c] || (b[c] = {});
                                var d = b.maps || (b.maps = {}),
                                    r = new Set,
                                    e = new URLSearchParams,
                                    u = () => h || (h = new Promise(async (f, n) => {
                                        await (a = m.createElement("script"));
                                        e.set("libraries", [...r] + "");
                                        for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                                        e.set("callback", c + ".maps." + q);
                                        a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                                        d[q] = f;
                                        a.onerror = () => h = n(Error(p + " could not load."));
                                        a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                                        m.head.append(a)
                                    }));
                                d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
                            })({
                                key: "AIzaSyDgGhu7gVtSqKxCC9tSywaqlPIpufe0CHs",
                                v: "weekly",
                            });
                        </script>


                    </div>
                </div>

            </div>
        </section>
<? }
}
