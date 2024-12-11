<?php

class Single_Course_Page_Editor_Section
{
    public function __construct() {
        $section_content = get_field('section_content');
        $this->topics = $section_content['topics'];
        $this->target_group_and_goals = $section_content['target_group_and_goals'];
        $this->certification = $section_content['certification'];
    }

    public function render()
    { ?>

        <section class="section seminar__editor editor">
            <div class="container">
                <div class="editor__list">
                    <?php if (!empty($this->topics)) :?>
                        <div class="editor__item">
                            <div class="editor__title">Themen</div>
                            <?php foreach ($this->topics as $item) : ?>
                                <div class="editor__content">
                                    <?php if (!empty($item['title'])) : ?>
                                        <span><strong><?php echo $item['title']; ?></strong></span>
                                    <?php endif; ?>
                                    <?php if (!empty($item['items'])) : ?>
                                        <ul>
                                            <?php foreach ($item['items'] as $text) : ?>
                                                <li><?php echo $text['text']; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($this->target_group_and_goals)) : ?>
                        <div class="editor__item">
                            <div class="editor__title">Zielgruppe und Ziele</div>
                            <div class="editor__content">
                                <p><?php echo $this->target_group_and_goals; ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($this->certification)) : ?>
                        <div class="editor__item">
                            <div class="editor__title">Zertifizierung</div>
                            <div class="editor__content">
                                <p><?php echo $this->certification; ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </section>
<? }
}
