<?php

namespace rgen3\blog\common\models;

use Yii;

/**
 * This is the model class for table "{{%blog_record_translation}}".
 *
 * @property integer $record_id
 * @property string $language_code
 * @property string $title
 * @property string $preview
 * @property string $body
 * @property string $image
 *
 * @property BlogRecord $record
 */
class BlogRecordTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_record_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['record_id', 'language_code'], 'required'],
            [['record_id'], 'integer'],
            [['title', 'preview', 'body'], 'string'],
            [['language_code'], 'string', 'max' => 10],
            [['image'], 'string', 'max' => 255],
            [['record_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogRecord::className(), 'targetAttribute' => ['record_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'record_id' => Yii::t('app', 'Record ID'),
            'language_code' => Yii::t('app', 'Language Code'),
            'title' => Yii::t('app', 'Title'),
            'preview' => Yii::t('app', 'Preview'),
            'body' => Yii::t('app', 'Body'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecord()
    {
        return $this->hasOne(BlogRecord::className(), ['id' => 'record_id']);
    }

    public function getTags()
    {
        return $this->hasMany(BlogTag::className(), ['id' => 'record_id']);
    }

}
