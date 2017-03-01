<?php
use \yii\helpers\Html;
use rgen3\blog\backend\Module as M;
use yii\widgets\DetailView;
use \yii\helpers\Url;
?>

<?= Html::tag('h1', M::t('admin', 'View blog record'));?>

<?= Html::beginTag('div', ['class' => 'row']); ?>
<?= Html::beginTag('div', ['class' => 'col-sm-2']); ?>
    <?= Html::a(M::t('admin', 'Create another category'), Url::to(['create']), ['class' => 'btn btn-success']); ?>
    <?= Html::endTag('div'); ?>
    <?= Html::beginTag('div', ['class' => 'col-sm-2']); ?>
    <?= Html::a(M::t('admin', 'Update category'), Url::to(['update', 'id' => $model->id]), ['class' => 'btn btn-info']); ?>
    <?= Html::endTag('div'); ?>
<?= Html::endTag('div'); ?>

<?= Html::tag('div', '', ['class' => 'divider']) ;?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        [
            'label' => 'Parent category',
            'value' => function($model) {
                return $model->parent_id;
            }
        ],
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
            'description'
        ]

    ]); ?>
<?php endforeach; ?>