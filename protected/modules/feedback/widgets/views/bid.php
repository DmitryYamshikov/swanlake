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
    $labelMessenger = $factory->getOption("attributes.messenger.label");
    $labelWeChat = $factory->getOption("attributes.wechat.label");
    $labelEmail = $factory->getOption("attributes.email.label");
    $labelDate = $factory->getOption("attributes.date.label");
    $labelEducation = $factory->getOption("attributes.education.label");
    $labelSpecialty = $factory->getOption("attributes.specialty.label");
    $labelCity = $factory->getOption("attributes.city.label");
    $labelJob = $factory->getOption("attributes.job.label");
    $labelMatrialStatus = $factory->getOption("attributes.matrial_status.label");
    $labelHeight = $factory->getOption("attributes.height.label");
    $labelWeight = $factory->getOption("attributes.weight.label");
    $labelHeirColor = $factory->getOption("attributes.heir_color.label");
    $labelHobby = $factory->getOption("attributes.hobby.label");
    $labelPositiveFeature = $factory->getOption("attributes.positive_feature.label");
    $labelNegativeFeature = $factory->getOption("attributes.negative_feature.label");
    $labelBadHabits = $factory->getOption("attributes.bad_habits.label");
    $labelForeignLanguages = $factory->getOption("attributes.foreign_languages.label");
    $labelRequirements = $factory->getOption("attributes.requirements.label");
    $labelForeigners = $factory->getOption("attributes.foreigners.label");
    $labelSocialNetwork = $factory->getOption("attributes.social_network.label");
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

        <label class="label label-messenger">
            <span><?= $labelMessenger; ?></span>
            <?= $fields['messenger']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-wechat">
            <span><?= $labelWeChat; ?></span>
            <?= $fields['wechat']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-email">
            <span><?= $labelEmail; ?></span>
            <?= $fields['email']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-date">
            <span><?= $labelDate; ?></span>
            <?= $fields['date']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-education">
            <span><?= $labelEducation; ?></span>
            <?= $fields['education']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-specialty">
            <span><?= $labelSpecialty; ?></span>
            <?= $fields['specialty']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-city">
            <span><?= $labelCity; ?></span>
            <?= $fields['city']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-job">
            <span><?= $labelJob; ?></span>
            <?= $fields['job']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-matrial_status">
            <?= $form->label($model,'matrial_status'); ?>
            <?= $form->radioButtonList($model,'matrial_status',array(
                'Не замужем' => 'Не замужем',
                'Замужем' => 'Замужем',
                'Разведена' => 'Разведена',
                'Вдова' => 'Вдова')); ?>
        </label>

        <label class="label label-children">
            <?= $form->label($model,'children'); ?>
            <?= $form->radioButtonList($model,'children',array(
                'Нет' => 'Нет',
                'Один' => 'Один',
                'Два' => 'Два',
                'Три' => 'Три',
                'Больше трех' => 'Больше трех')); ?>
        </label>

        <label class="label label-height">
            <span><?= $labelHeight; ?></span>
            <?= $fields['height']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-weight">
            <span><?= $labelWeight; ?></span>
            <?= $fields['weight']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-heir_color">
            <span><?= $labelHeirColor; ?></span>
            <?= $fields['heir_color']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-hobby">
            <span><?= $labelHobby; ?></span>
            <?= $fields['hobby']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-positive_feature">
            <span><?= $labelPositiveFeature; ?></span>
            <?= $fields['positive_feature']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-negative_feature">
            <span><?= $labelNegativeFeature; ?></span>
            <?= $fields['negative_feature']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-bad_habits">
            <span><?= $labelBadHabits; ?></span>
            <?= $fields['bad_habits']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-foreign_languages">
            <span><?= $labelForeignLanguages; ?></span>
            <?= $fields['foreign_languages']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-requirements">
            <span><?= $labelRequirements; ?></span>
            <?= $fields['requirements']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-foreigners">
            <span><?= $labelForeigners; ?></span>
            <?= $fields['foreigners']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-social_network">
            <span><?= $labelSocialNetwork; ?></span>
            <?= $fields['social_network']->getModel()->widget($factory, $form, $this->params) ?>
        </label>

        <label class="label label-сommunication_method">
            <?= $form->label($model,'сommunication_method'); ?>
            <?= $form->radioButtonList($model,'сommunication_method',array(
                'E-mail' => 'E-mail',
                'Телефон' => 'Телефон',
                'Мессенджер' => 'Мессенджер',
                'Соцсеть' => 'Соцсеть')); ?>
        </label>

        <label class="label label-file1">
            <?= $form->label($model,'file1'); ?>
            <?= $form->fileField($model,'file1',array('size'=>60,'maxlength'=>255)); ?>
        </label>

        <label class="label label-file2">
            <?= $form->label($model,'file2'); ?>
            <?= $form->fileField($model,'file2',array('size'=>60,'maxlength'=>255)); ?>
        </label>

        <label class="label label-file3">
            <?= $form->label($model,'file3'); ?>
            <?= $form->fileField($model,'file3',array('size'=>60,'maxlength'=>255)); ?>
        </label>

        <div class="bottom">
            <div class="check">
                <?= $fields['privacy_policy_bid']->getModel()->widget($factory, $form, $this->params) ?>
            </div>

            <?= CHtml::submitButton($factory->getOption('controls.send.title', 'Отправить'), [
                'class' => 'feedback-submit-button btn',
                //'id' => $factory->getModelFactory()->getModel()->recaptchaBehavior->attachReCaptchaBySubmitButton()
            ]); ?>
        </div>
    </div>

    <div class="feedback-footer"></div>

    <?php $this->endWidget(); ?>
</div>