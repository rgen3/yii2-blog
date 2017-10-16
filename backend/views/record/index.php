<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rgen3\blog\backend\Module as M;

$this->title = M::t('admin', 'List blog records');
$this->params['breadcrumbs'][] = $this->title;

?>
    <p>
        <?= Html::a(M::t('admin', 'Add blog record'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?= GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => \yii\grid\SerialColumn::class],
            [
                'label' => 'Категории',
                'value' => function ($model) {
                    $categories = array_map(function($model){
                        return $model->title;
                    }, $model->getCategories()->all() ?? []);
                    return implode(', ', $categories);
                }
            ],
            [
                'label' => 'Заголовок',
                'value' => function ($model) {
                    return $model->translation->title;
                }
            ],
            'date_created',

            ['class' => \yii\grid\ActionColumn::class]
        ]
    ]
);?>