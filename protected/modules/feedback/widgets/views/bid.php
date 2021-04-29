<?php

/** @var FeedbackWidget $this */
/** @var FeedbackFactory $factory */

use common\components\helpers\HYii as Y;

Y::js(
    'feedback' . $this->getHash(),
    'var feedback' . $this->getHash() . '=FeedbackWidget.clone(FeedbackWidget);feedback' . $this->getHash() . '.init("' . $this->id . '");'
);

?>
<div id="<?= $this->id; ?>" class="<?= $this->getOption('html', 'class'); ?>">
    <?php
    $form = $this->beginWidget('CActiveForm', [
        'id' =>  $this->getFormId(),
        'action' => $this->getFormAction(),
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'clientOptions' => [
            'validateOnSubmit' => true,
            'validateOnChange' => false,
            'afterValidate' => 'js:feedback' . $this->getHash() . '.afterValidate',
        ],
        'htmlOptions' => [
            'class' => 'bid-form'
        ]
    ]);
    $model = $factory->getModelFactory()->getModel();
    $fields = $factory->getModelFactory()->getAttributes();

    $labelName = $factory->getOption("attributes.name.label");
    $labelPhone = $factory->getOption("attributes.phone.label");
    $labelCommentary = $factory->getOption("attributes.commentary.label");
    $labelPrivacy = $factory->getOption("attributes.privacy_policy.label");
    ?>

    <?= CHtml::hiddenField('formId', $this->getFormId()); ?>

    <?php
    if (is_callable($this->onBefore)) call_user_func($this->onBefore, $model);
    ?>

    <?php if ($this->title) : ?>
        <div class="cbHead">
            <p><?= $this->title; ?></p>
        </div>
    <?php endif; ?>

    <div class="feedback-body fields">
        <label class="label label-name">
            <span><?= $labelName; ?></span>
            <?= $fields['name']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-phone">
            <span><?= $labelPhone; ?></span>
            <?= $fields['phone']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-commentary">
            <span><?= $labelCommentary; ?></span>
            <?= $fields['commentary']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <div class="bottom">
            <div class="check">
                <?= $fields['privacy_policy']->getModel()->widget($factory, $form, $this->params) ?>
            </div>

            <?php if ($factory->getModelFactory()->getModel()->useCaptcha) {
                $this->widget('feedback.widgets.captcha.CaptchaWidget');
            } ?>

            <?= CHtml::submitButton($factory->getOption('controls.send.title', 'Отправить'), [
                'class' => 'feedback-submit-button btn',
                'id' => $factory->getModelFactory()->getModel()->recaptchaBehavior->attachReCaptchaBySubmitButton()
            ]); ?>
        </div>
    </div>

    <div class="feedback-footer"></div>

    <?php $this->endWidget(); ?>
</div>