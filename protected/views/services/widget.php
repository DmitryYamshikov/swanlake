<? if (D::yd()->isActive('services')) : ?>
    <div class="services__list <?= $template_name ?>">
        <?php foreach ($dataProvider->getData() as $item) { ?>
            <div class="service__item">
                <a href="<?= $item->getPageUrl() ?>">
                    <img src="<?= $item->getSrc() ?>" alt="<?= $item->image_alt ?>" />
                    <div class="service__title">
                        <?= $item->title ?>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
<?php endif; ?>