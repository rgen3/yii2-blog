<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rgen3\blog\backend\Module as M;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'slug'); ?>

<?= $form->field($model, 'parent_id'); ?>

<?php foreach (Yii::$app->params['availableLanguages'] as $lang) : ?>
    <?php $translationModel = $model->getTranslationModel($lang); ?>
    <?= $form->field($translationModel, "[{$lang}]title"); ?>
<?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? M::t('admin', 'Create blog category') : M::t('admin', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end();?>