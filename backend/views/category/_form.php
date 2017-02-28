<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rgen3\blog\backend\Module as M;
use rgen3\blog\common\models\BlogCategory;
use yii\helpers\ArrayHelper;
?>

<?php $form = ActiveForm::begin([
    'method' => 'post',
    'action' => '/blog/category/create',
    'options' => [
        'data-pjax' => 'true'
    ]
]); ?>

<?= $form->field($model, 'slug'); ?>

<?= $form->field($model, 'parent_id')->dropDownList($model->getParentList()); ?>

<?php $items = []; ?>
<?php foreach (Yii::$app->params['availableLanguages'] as $lang) : ?>

    <?php $translationModel = $model->getTranslation($lang, true); ?>
    <?php $content = $form->field($translationModel, "[{$lang}]title")->label(M::t('admin', "Title") . " {$lang}"); ?>

    <?php $image = $translationModel->image != '' ? Html::img($translationModel->image) : '' ;?>
    <?php $content .= Html::tag('div', $image, ['id' => 'image']); ?>

    <?php $content .= $form->field($translationModel, "[{$lang}]image")
        ->label(M::t('admin', 'Image' . " {$lang}"))
        ->widget(\pendalf89\filemanager\widgets\FileInput::className(), [
            'buttonTag' => 'button',
            'buttonName' => 'Browse',
            'imageContainer' => '#image',
            'buttonOptions' => ['class' => 'btn btn-default'],
            'options' => ['class' => 'form-control'],
        ]); ?>
    <?php $content .= $form->field($translationModel, "[{$lang}]description")
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