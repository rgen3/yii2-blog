<?php

use rgen3\blog\backend\Module as M;


$this->title = M::t('admin', 'Edit blog tag');

?>


<div class="blog-record-create">

    <?= $this->render('_form', ['model' => $model]); ?>

</div>
