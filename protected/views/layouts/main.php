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