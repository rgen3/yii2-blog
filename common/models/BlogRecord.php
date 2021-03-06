<?php

namespace rgen3\blog\common\models;

use Yii;
use yii\helpers\ArrayHelper;

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

    public $categories = null;
    public $translationModels = [];

    public function afterSave($insert, $changedAttributes)
    {
        foreach ($this->translationModels as $language => $translation)
        {
            $translation->record_id = $this->id;
            $translation->language_code = $language;
            $translation->save();
        }

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public function saveCategories()
    {
        array_map(
            function($el)
            {
                $el->delete();
            },
            BlogRecordToCategory::findAll(['record_id' => $this->id])
        );


        if ($this->categories)
        foreach ($this->categories as $category)
        {
            $bnd = new BlogRecordToCategory();
            $bnd->category_id = $category;
            $bnd->record_id = $this->id;
            $bnd->save();
        }
    }

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
            [['id'], 'integer'],
            [['date_created', 'date_publish'], 'safe'],
            [['type'], 'string', 'max' => 20],
            [['slug'], 'string', 'max' => 255],
            [['categories'], 'each', 'rule' => ['integer']]
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

    public function getTranslation($lang = null)
    {
        if (is_null($lang))
        {
            $lang = Yii::$app->language;
        }

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

    public function getRecordCategories()
    {
        return $this->getCategories();
    }

    public function getCategories()
    {
        return $this->hasMany(
            BlogCategoryTranslation::className(),
            [ 'category_id' => 'category_id' ]
        )
            ->viaTable(BlogRecordToCategory::tableName(), ['record_id' => 'id'])
            ->where(['like', 'language_code', Yii::$app->language]);
    }

    public function getSelectedCategories()
    {
        $where = $this->id ? ['record_id' => $this->id ] : [];
        return ArrayHelper::map(BlogRecordToCategory::findAll($where), 'category_id', 'category_id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogRecordTranslations()
    {
        return $this->hasMany(BlogRecordTranslation::className(), ['record_id' => 'id']);
    }

    /**
     * @return false|int
     */
    public function remove()
    {
        foreach (BlogRecordTranslation::findAll(['record_id' => $this->id]) as $model)
        {
            $model && $model->delete();
        }

        return $this->delete();
    }
}
