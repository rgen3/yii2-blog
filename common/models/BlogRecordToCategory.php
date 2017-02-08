<?php

namespace rgen3\blog\common\models;

use yii\db\ActiveRecord;

class BlogRecordToCategory extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%blog_record_to_category}}';
    }

    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['record_id'], 'integer']
        ];
    }

}