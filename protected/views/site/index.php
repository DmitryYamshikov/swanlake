<?php foreach (IBHelper::getElements(1) as $element): ?>
<div class="banner" style="background-image: url(<?=$element['preview']?>)">
    <div class="banner__text">
        <div class="banner__title"><?= $element[props][title]?></div>
        <div class="banner__subtitle"><?= $element[props][subtitle]?></div>
    </div>
</div>
<?php  endforeach; ?>
<div class="page-content">
    <div class="page-content__container container">
        <?/* \crud\models\ar\Service::widget(); */?>
        <?= $page->text ?>
    </div>
</div>

<section class="reasons">
    
</section>
