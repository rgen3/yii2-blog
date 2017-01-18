<?php
use \yii\helpers\Html;
use rgen3\blog\backend\Module as M;
use yii\widgets\DetailView;
?>

<?= Html::tag('h1', M::t('admin', 'View blog record'));?>

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
            'preview:html',
            'body:html'
        ]

    ]); ?>
<?php endforeach; ?>