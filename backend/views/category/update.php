<?php

use rgen3\blog\backend\Module as M;


$this->title = M::t('admin', 'Edit blog category');

?>


<div class="blog-category-create">

    <?= $this->render('_form', ['model' => $model]); ?>

</div>
