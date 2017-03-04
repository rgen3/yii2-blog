<?php

namespace rgen3\blog\common\models;

use Yii;

/**
 * This is the model class for table "{{%blog_tag_translation}}".
 *
 * @property int $tag_id
 * @property string $title
 * @property string $description
 * @property string $image
 *
 * @property BlogTag $tag
 */
class BlogTagTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_tag_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id'], 'default', 'value' => null],
            [['tag_id'], 'integer'],
            [['title', 'description'], 'string'],
            [['image'], 'string', 'max' => 255],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogTag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => Yii::t('app', 'Tag ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(BlogTag::className(), ['id' => 'tag_id']);
    }

    public function getSlug()
    {
        $this->hasOne(BlogTag::className(), ['id', 'tag_id']);
    }
}
