<?php

namespace rgen3\blog\common\models;

use Yii;

/**
 * This is the model class for table "{{%blog_to_tag}}".
 *
 * @property int $record_id
 * @property int $tag_id
 *
 * @property BlogRecord $record
 * @property BlogTag $tag
 */
class BlogToTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_to_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['record_id', 'tag_id'], 'required'],
            [['record_id', 'tag_id'], 'default', 'value' => null],
            [['record_id', 'tag_id'], 'integer'],
            [['record_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogRecord::className(), 'targetAttribute' => ['record_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogTag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'record_id' => Yii::t('app', 'Record ID'),
            'tag_id' => Yii::t('app', 'Tag ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecord()
    {
        return $this->hasOne(BlogRecord::className(), ['id' => 'record_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(BlogTag::className(), ['id' => 'tag_id']);
    }
}
