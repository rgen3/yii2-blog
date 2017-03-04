<?php
use \yii\helpers\Html;
use rgen3\blog\backend\Module as M;
use yii\widgets\DetailView;
use yii\helpers\Url;
?>

<?= Html::tag('h1', M::t('admin', 'View blog tag'));?>

<?= Html::beginTag('div', ['class' => 'row']); ?>
    <?= Html::beginTag('div', ['class' => 'col-sm-2']); ?>
    <?= Html::a(M::t('admin', 'Create another tag'), Url::to(['create']), ['class' => 'btn btn-success']); ?>
    <?= Html::endTag('div'); ?>
    <?= Html::beginTag('div', ['class' => 'col-sm-2']); ?>
    <?= Html::a(M::t('admin', 'Update tag'), Url::to(['update', 'id' => $model->id]), ['class' => 'btn btn-info']); ?>
    <?= Html::endTag('div'); ?>
<?= Html::endTag('div'); ?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'slug'
    ]
]);
?>

<?php $items = []; ?>
<?php foreach (Yii::$app->params['availableLanguages'] as $lang) : ?>
    <?php $modelTranslation = $model->getTranslation($lang); ?>
    <?= Html::tag('h1', $lang); ?>
    <?= DetailView::widget([
        'model' => $modelTranslation,
        'attributes' => [
            'title',
            [
                'label' => 'Image',
                'value' => Html::img($modelTranslation->image),
                'format' => 'raw'
            ],
            'description:html'
        ]

    ]); ?>
<?php endforeach; ?>