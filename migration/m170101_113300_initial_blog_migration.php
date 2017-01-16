<?php

class m170101_113300_initial_blog_migration extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('{{%blog_record}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->char(255),
            'date_created' => $this->timestamp()->defaultValue('CURRENT_TIMESTAMP')
        ]);
    }

    public function down()
    {

    }
}