<?php
/**
 * @var $dataProvider \yii\data\BaseDataProvider
 * @var $model \rgen3\blog\common\models\BlogRecord
 * @var $translation \rgen3\blog\common\models\BlogRecordTranslation
 */

use \yii\helpers\Html;
use rgen3\blog\frontend\Module as M;

?>
<div class="container">
    <div class="b-news">
        <h3 class="title"><?= $blockHeading;?> :</h3>
        <?php foreach ( $dataProvider->models as $model ) : ?>
            <?php $translation = $model->translation; ?>
        <div class="news__item">
            <div class="news_left">
                <div class="news-img">
                    <?= Html::img($translation->image, ['alt' => $translation->title]); ?>
                </div>
                <p class="news-date"><?= Yii::$app->formatter->asDate($model->date_publish, 'php:Y-m-d h:i:s'); ?></p>
            </div>
            <div class="news_right">
                <p class="news-title"><?= $translation->title; ?></p>
                <p class="news-text">
                    <?= $translation->body; ?>
                </p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
