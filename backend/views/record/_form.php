<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rgen3\blog\backend\Module as M;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

$pjaxInputContainerId = 'pjax-category-input';

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'slug'); ?>

<?php $categoryList = $categories->parentList; ?>

<?php Pjax::begin([
        'id' => $pjaxInputContainerId,
        'enablePushState' => false,
        'enableReplaceState' => false
    ]); ?>

<?= Html::beginTag('div', ['class' => 'col-sm-8']); ?>
    <?= $form->field($model, 'categories')
        ->widget(\kartik\select2\Select2::class,
            [
                'data' => $categoryList,
                'options' => [
                    'placeholder' => M::t('admin', 'Select blog categories'),
                    'multiple' => true,
                    'value' => $model->getSelectedCategories(),
                ],
            ]); ?>
<?= Html::endTag('div'); ?>
<?= Html::beginTag('div', ['class' => 'col-sm-4']); ?>
    <?= Html::button(M::t('admin', 'Create category'), [
        'class' => 'btn btn-success',
        'data' => [
            'toggle' => 'modal',
            'target' => '#pjax-category-add-modal'
        ]
    ]); ?>
<?= Html::endTag('div'); ?>
<?php Pjax::end(); ?>


<?= Html::tag('div', '', ['class' => 'clearfix']); ?>
<?php $items = []; ?>

<?php foreach (Yii::$app->params['availableLanguages'] as $lang) : ?>
<?php $translationModel = $model->getTranslation($lang); ?>

    <?php $content = $form->field($translationModel, "[{$lang}]title")->label(M::t('admin', "Title") . " {$lang}"); ?>

    <?php $content .= $form->field($translationModel, "[{$lang}]image")
        ->label(M::t('admin', 'Image' . " {$lang}"))
        ->widget(\pendalf89\filemanager\widgets\FileInput::className(), [
            'buttonTag' => 'button',
            'buttonName' => 'Browse',
            'buttonOptions' => ['class' => 'btn btn-default'],
            'options' => ['class' => 'form-control'],
        ]); ?>

    <?php $content .= $form->field($translationModel, "[{$lang}]preview")
        ->label(M::t('admin', "Description") . " {$lang}")
        ->widget(\pendalf89\tinymce\TinyMce::className(), [
            'clientOptions' => [
                'language' => 'ru',
                'menubar' => false,
                'height' => 200,
                'image_dimensions' => false,
                'plugins' => [
                    'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code contextmenu table',
                ],
                'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
            ],
        ]); ?>

    <?php $content .= $form->field($translationModel, "[{$lang}]body")
        ->label(M::t('admin', "Description") . " {$lang}")
        ->widget(\pendalf89\tinymce\TinyMce::className(), [
            'clientOptions' => [
                'language' => 'ru',
                'menubar' => false,
                'height' => 200,
                'image_dimensions' => false,
                'plugins' => [
                    'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code contextmenu table',
                ],
                'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
            ],
        ]); ?>

    <?php $items[] = [
        'label' => $lang,
        'content' => $content
    ];?>

<?php endforeach; ?>

    <?= \yii\bootstrap\Tabs::widget(['items' => $items]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? M::t('admin', 'Create blog category') : M::t('admin', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end();?>

<?php /** Creates modal for pjax category adding */ ?>
<?php $this->render('_form_modal', ['modalId' => 'pjax-category-add-modal', 'pjaxInputContainerId' => $pjaxInputContainerId]); ?>
