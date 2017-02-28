<?php

class m170228_004920_primary_keys extends \yii\db\Migration
{
    public function up()
    {
        $this->addPrimaryKey('pk-blog_category_translation', '{{%blog_category_translation}}', ['category_id', 'language_code']);
    }
}