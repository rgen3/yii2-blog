<?php

use rgen3\blog\backend\Module as M;


$this->title = M::t('admin', 'Add blog record');

?>

<div class="blog-record-create">
    <?= $this->render('_form', ['model' => $model, 'categories' => $categories]); ?>
</div>
