<?php foreach (IBHelper::getElements(1) as $element) : ?>
    <div class="banner" style="background-image: url(<?= $element['preview'] ?>)">
        <div class="banner__text">
            <div class="banner__title"><?= $element['props']['title'] ?></div>
            <div class="banner__subtitle"><?= $element['props']['subtitle'] ?></div>
        </div>
    </div>
<?php endforeach; ?>
<div class="page-content">
    <div class="page-content__container container">

        <?= $page->text ?>
    </div>
</div>

<section class="reason">
    <div class="container">
        <?php $iblock = IBHelper::getIblockByPk(2); ?>
        <div class="reason__title"><?= $iblock->title; ?></div>
        <div class="reason__wrapper">
            <?php foreach (IBHelper::getElements(2) as $element) : ?>
                <div class="reason__item">
                    <div class="reason__img">
                        <img src="<?= $element['preview'] ?>" alt="img">
                    </div>
                    <div class="reason__decor"></div>
                    <div class="reason__descr">
                        <span><?= $element['description'] ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="toankete">
    <div class="container">
        <div class="toankete__wrapper">
            <div class="toankete__img"><img src="/images/heart.png" alt="heart"></div>
            <div class="toankete__text">
                <div class="toankete__title">Хотите найти китайского мужа? Заполните нашу анкету</div>
                <div class="toankete__subtitle">Это займёт всего несколько минут</div>
                <a class='btn' href="/anketa">Хочу замуж!</a>
            </div>
        </div>
    </div>
</section>