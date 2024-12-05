<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="<?=TEMPLATE_PATH?>/styles/normalize.css">
    <link rel="stylesheet" href="<?=TEMPLATE_PATH?>/styles/critical.css">
    <link rel="stylesheet" href="<?=TEMPLATE_PATH?>/styles/index.css">
</head>
<body>
<?php 
$header = get_field('header',Page_Option::get_ID());
$white_logo = $header['white_logo'];
$green_image = $header['green_image'];
$menu = $header['menu'];
$button = $header['button'];
?>
<?php if (Page_Failed_Payment::get_ID() == get_the_ID() or Page_Successful_Payment::get_ID() == get_the_ID() or (in_array(get_the_ID(),Page_Text::get_IDs()))) : ?>
    <div class="wrap wrap__black">
<?php else : ?>
    <div class="wrap">
<?php endif; ?>
  <header class="header" >
      <div class="container">
          <div class="header__flex">
              <div class="header__block">
                  <?php if (!empty($white_logo)) : ?>
                    <a class="header__logo img " href="<?php echo home_url(); ?>">
                        <img src="<?php echo $white_logo; ?>" alt="Logo">
                    </a>
                  <?php endif; ?>
                  <?php if (!empty($green_image)) : ?>
                    <a class="header__logo header__logo-mob img " href="./../index.html">
                        <img src="<?php echo $green_image; ?>" alt="Logo">
                    </a>
                  <?php endif; ?>
                  <?php if (!empty($menu)) : ?>
                    <div class="header__menu">
                        <div class="header__menu-list">
                            <?php foreach ($menu as $item) : ?>
                                <a href="<?php echo $item['link']['url']; ?>" class="section__text white"><?php echo $item['link']['title']; ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                  <?php endif; ?>
              </div>
             <div class="header__right">
                 <div class="header__search-wrap">
                     <form class="header__search">
                         <input type="hidden" name="action" value="search_header">
                         <div class="header__search-input">
                             <input type="text" name="search" placeholder="Suche auf der Website...">
                         </div>
                         <button class="header__search-clean" type="button"></button>
                     </form>
                     <div class="header__search-result">
                         <div class="header__search-list">
                             <a href="" class="header__search-item">
                                 <div class="header__search-info">
                                     <span>Schulungen</span>
                                     <h3 >Qualitätsmanagement</h3>
                                 </div>
                             </a>
                             <a href="" class="header__search-item">
                                 <div class="header__search-info">
                                     <span >Schulungen</span>
                                     <h3 >Qualitätsmanagement</h3>
                                 </div>
                             </a>
                             <a href="" class="header__search-item">
                                 <div class="header__search-info">
                                     <span >Schulungen</span>
                                     <h3 >Qualitätsmanagement</h3>
                                 </div>
                             </a>
  
                         </div>
                         <div class="header__search-empty ">
                             <p class="section__text ">No result found</p>
                         </div>
                     </div>
                 </div>
                 <button class="header__search-icon ">
                     <span class="img"> <img src="<?=TEMPLATE_PATH?>/img/search.svg" alt=""></span>
                 </button>
                 <?php if (!empty($button)) : ?>
                    <a href="<?php echo $button['url']; ?>" class="section__button primary"><?php echo $button['title']; ?></a>
                 <?php endif; ?>
                 <div class="header__burger"><span></span><span></span></div>
  
             </div>
          </div>
      </div>
  </header>
  <div class="modal modal__thank">
      <div class="modal__wrap">
          <div class="modal__content ">
              <div class="modal__close img">
                  <img src="<?=TEMPLATE_PATH?>/img/clear.svg" alt="">
              </div>
              <div class="modal__overflow">
                  <div class="modal__block">
                      <h3 class="modal__title">Danke! </h3>
                      <p class="modal__text">Wir werden Sie kontaktieren</p>
                  </div>
              </div>
          </div>
      </div>
  </div>