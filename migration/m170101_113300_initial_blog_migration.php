<?php

use \yii\db\Expression;

class m170101_113300_initial_blog_migration extends \yii\db\Migration
{
    public function up()
    {
        $options = null;
        if ($this->db->driverName === 'mysql'){

            $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1';
        }

        $this->createTable('{{%blog_record}}', [
            'id' => $this->primaryKey(),
            'type' => $this->char(20),
            'slug' => $this->char(255),
            'date_created' => $this->timestamp()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
            'date_publish' => $this->dateTime()
        ], $options);

        $this->createTable('{{%blog_record_translation}}', [
            'record_id' => $this->integer(),
            'language_code' => $this->char(10),
            'title' => $this->text(),
            'preview' => $this->text(),
            'body' => $this->text(),
            'image' => $this->char(255)
        ], $options);

        $this->addPrimaryKey('pk-blog_record_translation', '{{%blog_record_translation}}', ['record_id', 'language_code']);
        $this->addForeignKey('fk-blog_record_translation', '{{%blog_record_translation}}', 'record_id', '{{%blog_record}}', 'id');

        $this->createTable('{{%blog_category}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'slug' => $this->char(255),
            'date_created' => $this->timestamp()->defaultValue(new Expression('CURRENT_TIMESTAMP'))
        ]);

        $this->addForeignKey('fk-blog_category_tree', '{{%blog_category}}', 'parent_id', '{{%blog_category}}', 'id');

        $this->createTable('{{%blog_category_translation}}', [
            'category_id' => $this->integer(),
            'language_code' => $this->char(10),
            'title' => $this->text(),
            'description' => $this->text(),
            'image' => $this->char(255)
        ]);

        $this->addForeignKey('fk-blog_category_translation', '{{%blog_category_translation}}', 'category_id', '{{%blog_category}}', 'id');

        // --------

        $this->createTable('{{%blog_record_to_category}}', [
            'record_id' => $this->integer(),
            'category_id' => $this->integer()
        ]);

        $this->addPrimaryKey('pk-blog_record_to_category', '{{%blog_record_to_category}}', ['record_id', 'category_id']);

        $this->addForeignKey(
            'fk-blog_record_to_category_blog_record',
            '{{%blog_record_to_category}}',
            'record_id',
            '{{%blog_record}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-blog_record_to_category_blog_category',
            '{{%blog_record_to_category}}',
            'record_id',
            '{{%blog_category}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-blog_record_to_category_blog_category', '{{%blog_record_to_category}}');
        $this->dropForeignKey('fk-blog_record_to_category_blog_record', '{{%blog_record_to_category}}');
        $this->dropTable('{{%blog_record_to_category}}');
        $this->dropForeignKey('fk-blog_category_translation', '{{%blog_category_translation}}');
        $this->dropTable('{{%blog_category_translation}}');
        $this->dropForeignKey('fk-blog_category_tree', '{{%blog_category}}');
        $this->dropTable('{{%blog_category}}');
        $this->dropForeignKey('fk-blog_record_translation', '{{%blog_record_translation}}');
        $this->dropTable('{{%blog_record_translation}}');
        $this->dropTable('{{%blog_record}}');
    }
}