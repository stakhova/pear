 <!-- FOOTER -->
 <?php
    $footer = get_field('footer', Page_Option::get_ID());
    $logotype = $footer['logotype'];
    $title = str_replace(['[',']'],['<span>','</span>'],$footer['title']);
    $left_button = $footer['left_button'];
    $right_button = $footer['right_button'];
    $menu = $footer['menu'];
    $address = $footer['address'];
    $phone = $footer['phone'];
    $email = $footer['email'];
    $privacy_policy = $footer['privacy_policy'];
    $impressum = $footer['impressum'];
?>
 <footer class="footer">
     <div class="container">
        <div class="footer__back img">
            <img src="<?=TEMPLATE_PATH?>/img/footer-bg.svg" alt="">
        </div>
         <div class="footer__block">
             <div class="footer__item">
                <?php if (!empty($logotype)) : ?>
                    <a class="footer__logo img" href="<?php echo home_url(); ?>">
                        <img src="<?php echo $logotype; ?>" alt="">
                    </a>
                 <?php endif; ?>
                 <?php if (!empty($title)) : ?>
                    <h2 class="footer__title"><?php echo $title; ?></h2>
                 <?php endif; ?>
                <div class="footer__btn">
                    <a href="<?php echo $left_button['url']; ?>" class="section__button primary"><?php echo $left_button['title']; ?></a>
                    <a href="<?php echo $right_button['url']; ?>" class="section__button"><?php echo $right_button['title']; ?></a>
                </div>
             </div>
             <div class="footer__menu-wrap">
                <?php if (!empty($menu)) : ?>
                    <div class="footer__menu">
                        <h2 class="section__subtitle">Navigation</h2>
                        <div class="footer__list">
                            <?php foreach ($menu as $item) : ?>
                                <a class="section__text" href="<?php echo $item['link']['url']; ?>"><?php echo $item['link']['title']; ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                 <?php endif; ?>
                 <div class="footer__menu">
                     <h2 class="section__subtitle">Kontaktinformationen</h2>
                     <div class="footer__list">
                        <?php if (!empty($address['url'])) : ?>
                            <a class="section__text" href="<?php echo $address['url']; ?>"><?php echo str_replace('|','<br>',$address['title']); ?></a>
                        <?php endif; ?>
                        <?php if (!empty($phone)) : ?>
                            <a class="section__text" href="tel:+<?=preg_replace('/[^\d]/', '', $phone); ?>"><?php echo $phone; ?></a>
                        <?php endif; ?>
                        <?php if (!empty($email)) : ?>
                            <a class="section__text" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                        <?php endif; ?>
                     </div>
                 </div>
             </div>
         </div>
         <div class="footer__bottom">
             <div class="footer__block">
                 <p class="section__text">© <?php echo date('Y'); ?> Copyright | All right reserved</p>
                 <div class="footer__menu-wrap">
                     <a class="section__text" href="<?php echo $privacy_policy['url']; ?>"><?php echo $privacy_policy['title']; ?></a>
                     <a class="section__text" href="<?php echo $impressum['url']; ?>"><?php echo $impressum['title']; ?></a>
                 </div>
             </div>
         </div>
     </div>

 </footer>
 <!-- /FOOTER -->
 </div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script type="text/javascript" src="<?= TEMPLATE_PATH ?>/scripts/plagins/device.js"></script>
 <script type="text/javascript" src="<?= TEMPLATE_PATH ?>/scripts/plagins/jquery.validate.min.js"></script>
 <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>



 <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/index.global.min.js"></script>
 <!-- DayGrid Plugin (сітка) -->
 <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/index.global.min.js"></script>
 <!-- List Plugin (список) -->
 <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/list@6.1.8/index.global.min.js"></script>
 <!-- Interaction Plugin (взаємодія) -->
 <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.8/index.global.min.js"></script>


 <script type="text/javascript" src="<?= TEMPLATE_PATH ?>/scripts/develop/index.js"></script>
<?php wp_footer(); ?>
 </body>

 </html>