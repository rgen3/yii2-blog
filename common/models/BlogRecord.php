<?php

namespace rgen3\blog\common\models;

use Yii;

/**
 * This is the model class for table "{{%blog_record}}".
 *
 * @property integer $id
 * @property string $type
 * @property string $slug
 * @property string $date_created
 * @property string $date_publish
 *
 * @property BlogRecordToCategory[] $blogRecordToCategories
 * @property BlogRecordTranslation[] $blogRecordTranslations
 */
class BlogRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_created', 'date_publish'], 'safe'],
            [['type'], 'string', 'max' => 20],
            [['slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'slug' => Yii::t('app', 'Slug'),
            'date_created' => Yii::t('app', 'Date Created'),
            'date_publish' => Yii::t('app', 'Date Publish'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogRecordToCategories()
    {
        return $this->hasMany(BlogRecordToCategory::className(), ['record_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogRecordTranslations()
    {
        return $this->hasMany(BlogRecordTranslation::className(), ['record_id' => 'id']);
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
