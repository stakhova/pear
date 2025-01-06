<?php

class Single_Seminar_Page_Editor_Section
{
    public function __construct() {
        $section_editor = get_field('section_editor');
        $this->place = $section_editor['place'];
        $this->map_link = $section_editor['map_link'];
        $this->map = $section_editor['map'];
        $this->content = $section_editor['content'];
        $this->certificate = $section_editor['certificate'];
        $this->speaker_image = $section_editor['speaker_image'];
        $this->speaker_title = $section_editor['speaker_title'];
        $this->speaker_text = $section_editor['speaker_text'];
    }

    public function render()
    { ?>

        <section class="section seminar__editor editor">
            <div class="container">
                <div class="editor__list">
                    <?php if (!empty($this->content)) : ?>
                        <?php foreach ($this->content as $item) : ?>
                            <div class="editor__item">
                                <div class="editor__title"><?php echo $item['title']; ?></div>
                                <div class="editor__content">
                                    <?php echo $item['text']; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
        
                    <?php if (!empty($this->certificate)) : ?>
                        <div class="editor__item">
                            <div class="editor__title">Zertifikat</div>
                            <div class="editor__back">
                                <div class="img">
                                    <img src="<?=TEMPLATE_PATH?>/img/content.png" alt="">
                                </div>
                                <h2 class="editor__title"><?php echo $this->certificate; ?></h2>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="editor__item">
                        <div class="editor__title">Referent</div>
                        <div>
                            <div class="seminar__user">
                                <?php if (!empty($this->speaker_image)) : ?>
                                    <div class="img">
                                        <img src="<?php echo $this->speaker_image; ?>" alt="">
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($this->speaker_title)) : ?>
                                    <h3><?php echo $this->speaker_title; ?></h3>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($this->speaker_text)) : ?>
                                <div class="editor__content">
                                    <?php echo $this->speaker_text; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="editor__item">
                        <div class="editor__title">Veranstaltungsort</div>
                        <div class="editor__content">
                            <p><?php echo $this->place; ?></p>
                            <div class="contact__map editor__map">
                                <div class="map__item" id="map"></div>

                                <script>
                                    let mapIcon = '<?=TEMPLATE_PATH?>/img/map-loc.svg';

                                    let positionMaps = [{
                                        lat: <?php echo $this->map['lat']; ?>,
                                        lng: <?php echo $this->map['lng']; ?>,
                                        text: '<a target="_blank" href="<?php echo $this->map_link; ?>">Eexplore on google maps</a>'
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
                </div>
            </div>

        </section>
<? }
}
