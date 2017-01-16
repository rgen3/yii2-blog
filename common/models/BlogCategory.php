<?php

namespace rgen3\blog\common\models;

use Yii;

/**
 * This is the model class for table "{{%blog_category}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $slug
 * @property string $date_created
 *
 * @property BlogCategory $parent
 * @property BlogCategory[] $blogCategories
 * @property BlogCategoryTranslation[] $blogCategoryTranslations
 * @property BlogRecordToCategory[] $blogRecordToCategories
 */
class BlogCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['date_created'], 'safe'],
            [['slug'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategory::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'slug' => Yii::t('app', 'Slug'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(BlogCategory::className(), ['id' => 'parent_id']);
    }

    public function getTranslationModel()
    {
        $model = new BlogCategoryTranslation();

        return $model;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogCategories()
    {
        return $this->hasMany(BlogCategory::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogCategoryTranslations()
    {
        return $this->hasMany(BlogCategoryTranslation::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogRecordToCategories()
    {
        return $this->hasMany(BlogRecordToCategory::className(), ['record_id' => 'id']);
    }
}
