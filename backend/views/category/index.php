<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rgen3\blog\backend\Module as M;

$this->title = M::t('admin', 'List blog categories');
$this->params['breadcrumbs'][] = $this->title;

?>
    <p>
        <?= Html::a(M::t('admin', 'Add blog category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?= GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => \yii\grid\SerialColumn::class],

            'slug',
            'date_created',

            ['class' => \yii\grid\ActionColumn::class]
        ]
    ]
);?>