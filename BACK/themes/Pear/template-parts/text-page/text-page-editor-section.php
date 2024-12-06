<?php

class Text_Page_Editor_Section
{
    public function __construct() {
        $this->items = get_field('section_content')['items'];
    }

    public function render()
    { ?>

        <?php if (!empty($this->items)) : ?>
            <section class="editor">
                <div class="container">
                    <div class="editor__list">
                        <?php foreach ($this->items as $item) : ?>
                            <div class="editor__item">
                                <div class="editor__title"><?php echo $item['title']; ?></div>
                                <div class="editor__content">
                                    <?php echo $item['text']; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </section>
        <?php endif; ?>
<? }
}
