<?php

use rgen3\blog\backend\Module as M;


$this->title = M::t('admin', 'Add blog record');

?>


<div class="blog-category-create">
    <?= $this->render('_form', ['model' => $model]); ?>
</div>
