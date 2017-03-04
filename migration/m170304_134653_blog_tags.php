<?php

use yii\db\Migration;

class m170304_134653_blog_tags extends Migration
{
    public function up()
    {
        $this->createTable('{{%blog_tag}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(255)
        ]);

        $this->createTable('{{%blog_tag_translation}}', [
            'tag_id' => $this->integer(),
            'language_code' => $this->string(10),
            'title' => $this->text(),
            'description' => $this->text(),
            'image' => $this->string(255)
        ]);

        $this->addPrimaryKey('pk-blog_tag_translation', '{{%blog_tag_translation}}', ['tag_id', 'language_code']);

        $this->addForeignKey(
            'fk-blog_tag_translation-blog_tag',
            '{{%blog_tag_translation}}',
            'tag_id',
            '{{%blog_tag}}',
            'id',
            'RESTRICT',
            'CASCADE');

        $this->addColumn('{{%blog_record_translation}}','tags', $this->text());

        $this->createTable('{{%blog_to_tag}}', [
            'record_id' => $this->integer(),
            'tag_id' => $this->integer()
        ]);
        $this->addPrimaryKey('pk-blog_to_tag', '{{%blog_to_tag}}', ['record_id', 'tag_id']);

        $this->addForeignKey('fk-blog_to_tag-to_blog_record', '{{%blog_to_tag}}', 'record_id', '{{%blog_record}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk-blog_to_tag-to_blog_tag', '{{%blog_to_tag}}', 'tag_id', '{{%blog_tag}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        echo "m170304_134653_blog_tag cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
