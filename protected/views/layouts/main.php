<?php

use common\components\helpers\HYii as Y; ?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
  CmsHtml::head();
  CmsHtml::js($this->template . '/js/bootstrap.min.js');
  CmsHtml::js($this->template . '/js/jquery.mmenu.all.js');
  CmsHtml::js($this->template . '/js/libs.js');
  CmsHtml::js($this->template . '/js/script.js');
  CmsHtml::js('/js/main.js');
  CmsHtml::js($this->template . '/js/custom.js');
  ?>

  <?php if (\Yii::app()->params['isAdaptive']) : ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <? else : ?>
    <meta name="viewport" content="width=device-width">
  <? endif; ?>
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="canonical" href="<?= $this->createAbsoluteUrl('/') . preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI']) ?>" />
</head>

<body class="<?= D::c($this->isIndex(), 'index-page', 'inner-page') ?>">

  <!-- Для мобильной версии есть два варианта шапки -->
  <!-- header-bottom--type-1 - Только телефеон -->
  <!-- header-bottom--type-2 - Телефон, поиск, иконки мессенжеров -->

  <div id="my-page">
    <header id="my-header" class="header">
      <div class="container">
        <div class="header__wrapper">
          <div class="logo-slogan">
            <a href="/" class="logo">
              <img src="/images/Logo.svg" alt="logo">
            </a>
            <div class="header__slogan">
              <?= D::cms('slogan') ?>
            </div>
          </div>
          <div class="menu">
            <?php $this->widget('\menu\widgets\menu\MenuWidget', array('rootLimit' => D::cms('menu_limit'), 'cssClass' => '')); ?>
          </div>
          <div class="menu-left" id="menu-left">
            <?php
            $this->widget('\menu\widgets\menu\MenuWidget', array(
              'rootLimit' => D::cms('menu_limit'),
              'cssClass' => 'menu1',
              'id' => 'menu'
            ));
            ?>
          </div>

          <a href="#menu-left" class="menu-toggle-link">
            <div class="menu-toggle">
              <span class="menu-toggle__item">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 384 384">
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path fill="#fff" data-original="#000000" d="M0 277.333h384V320H0zM0 170.667h384v42.667H0zM0 64h384v42.667H0z"></path>
                  </g>
                </svg>
              </span>

            </div>
          </a>
        </div>
      </div>
    </header>

    <main id="my-content" class="content">
      <?= $content ?>
    </main>

    <footer id="my-footer" class="footer">
      <div class="container">
        <div class="footer__wrapper">
          <div class="footer__row">
            <?php ModuleHelper::Copyright() ?>
            <a href="/privacy-policy" class="privacy-policy" target="_blanck">Политика конфиденциальности</a>
          </div>
          <div class="footer__row">
            <?= D::cms('privacy_policy_text') ?>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <div id="totop">
    <p>&#xe851;</p> ^ Наверх
  </div>

  <?php if (D::yd()->isActive('feedback')) : // обратный звонок 
  ?>
    <div style="display: none;">
      <div id="form-callback">
        <div class="popup-info">
          <?php $this->widget('\feedback\widgets\FeedbackWidget', array('id' => 'callback', 'title' => 'Заказать звонок')) ?>
        </div>
      </div>
    </div>
  <?php endif; // обратный звонок 
  ?>
</body>

</html>