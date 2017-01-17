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

    public function getTranslation($lang)
    {
        $model = BlogRecordTranslation::findOne(['record_id' => $this->id, 'language_code' => $lang]);

        if (!$model)
        {
            $model = new BlogRecordTranslation();
        }

        return $model;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogRecordToCategories()
    {
        return $this->hasMany(BlogRecordToCategory::className(), ['record_id' => 'id']);
    }

    public function getCategories()
    {
        return $this->hasMany(
            BlogCategoryTranslation::className(),
            [ 'record_id' => 'id']
        )->viaTable('{{%blog_record_to_category}}', ['category_id' => 'id'])->where(['like', 'language_code', Yii::$app->language]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogRecordTranslations()
    {
        return $this->hasMany(BlogRecordTranslation::className(), ['record_id' => 'id']);
    }
}
