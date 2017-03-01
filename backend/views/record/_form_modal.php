<?php

use yii\bootstrap\Modal;
use rgen3\blog\backend\Module as M;
use yii\widgets\Pjax;

$script = <<< JS
    $('#{$modalId}').on('hidden.bs.modal', function(){
        $.pjax.reload({ container : {$pjaxInputContainerId} });
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);
?>
<?php Modal::begin([
    'header' => M::t('admin', 'Create category'),
    'id' => 'pjax-category-add-modal',
    'toggleButton' => false //['label' => 'click me', 'class' => 'btn btn-success'],
]);?>
<?php Pjax::begin([
    'id' => 'pjax-create-category',
    'enablePushState' => false,
    'enableReplaceState' => false,])
;?>
<?= $this->render('/category/_form', ['model' => new \rgen3\blog\common\models\BlogCategory(), 'data' => ['pjax' => true]]); ?>
<?php Pjax::end(); ?>
<?php Modal::end(); ?>