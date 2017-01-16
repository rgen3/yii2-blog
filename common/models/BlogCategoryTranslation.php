<?php

namespace rgen3\blog\common\models;

use Yii;

/**
 * This is the model class for table "{{%blog_category_translation}}".
 *
 * @property integer $category_id
 * @property string $language_code
 * @property string $title
 * @property string $description
 * @property string $image
 *
 * @property BlogCategory $category
 */
class BlogCategoryTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_category_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['title', 'description'], 'string'],
            [['language_code'], 'string', 'max' => 10],
            [['image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('app', 'Category ID'),
            'language_code' => Yii::t('app', 'Language Code'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(BlogCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     * @return BlogCategoryTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlogCategoryTranslationQuery(get_called_class());
    }
}
