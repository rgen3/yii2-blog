<?php

class m10052017_201132_fixes_constraint extends \yii\db\Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE public.blog_record_to_category DROP CONSTRAINT \"fk-blog_record_to_category_blog_category\";");
        $this->execute("ALTER TABLE public.blog_record_to_category
        ADD CONSTRAINT \"fk-blog_record_to_category_blog_category\"
        FOREIGN KEY (record_id) REFERENCES blog_record (id) ON DELETE CASCADE ON UPDATE CASCADE;");
    }
}