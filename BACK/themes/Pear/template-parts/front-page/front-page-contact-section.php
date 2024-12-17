<?php

class Front_Page_Contact_Section
{
    public function __construct() {
        $section_contact = get_field('section_contact');
        $this->address = $section_contact['address'];
        $this->phone = $section_contact['phone'];
        $this->email = $section_contact['email'];
        $this->map_link = $section_contact['map_link'];
        $this->map = $section_contact['map'];
    }

    public function render()
    { ?>

        <section class="section contact">
            <div class="container">
                <div class="section__flex contact__flex">
                    <div class="contact__info">
                        <h2 class="contact__title">Kontakt</h2>
                        <div class="contact__list">
                            <?php if (!empty($this->address)) : ?>
                                <div class="contact__item">
                                    <span>Standort</span>
                                    <a class="section__subtitle"
                                        href="<?php echo $this->map_link; ?>"><?php echo $this->address; ?></a>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($this->phone)) : ?>
                                <div class="contact__item">
                                    <span>Rufnummer</span>
                                    <a class="section__subtitle" href="tel:+<?=preg_replace('/[^\d]/', '', $this->phone); ?>"><?php echo $this->phone; ?></a>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($this->email)) : ?>
                                <div class="contact__item">
                                    <span>E-Mail</span>
                                    <a class="section__subtitle"
                                        href="mailto:<?php echo $this->email; ?>"><?php echo $this->email; ?></a>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                    <style>
                        .gm-style-iw-chr{
                           display: none!important;
                        }
                        .gm-style-iw-d a{
                            font: 400 1.2rem / 1.3rem var(--GT) !important;
                            text-transform: uppercase!important;
                            color:white;
                        }
                        .gm-style-iw-d{
                            max-height: max-content!important;
                            padding: 0.8rem 1.2rem!important;
                        }
                        .gm-style .gm-style-iw-c, .gm-style .gm-style-iw-tc::after{
                            background-color:#023D27!important;
                            padding: 0!important;
                        }

                    </style>
                    <div class="contact__map">
                        <div class="map__item" id="map"></div>

                        <script>
                            let mapIcon = '<?=TEMPLATE_PATH?>/img/map-loc.svg';

                            let positionMaps = [{
                                lat: <?php echo $this->map['lat']; ?>,
                                lng: <?php echo $this->map['lng']; ?>,
                                text: '<a href="<?php echo $this->map_link; ?>">Explore on google maps</a>'
                            }]
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
