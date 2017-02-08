<?php

namespace rgen3\blog\backend\controllers;

use rgen3\blog\common\models\BlogCategory;
use rgen3\blog\common\models\BlogCategorySearch;
use rgen3\blog\common\models\BlogCategoryTranslation;
use yii\web\Controller;

class CategoryController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new BlogCategorySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new BlogCategory();

        $postData = \Yii::$app->request->post();

        if ($model->load($postData))
        {
            foreach (\Yii::$app->params['availableLanguages'] as $language)
            {
                $modelTranslation = new BlogCategoryTranslation();
                $modelTranslation->setAttributes($postData['BlogCategoryTranslation'][$language]);
                $model->translationModels[$language] = $modelTranslation;
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id)
    {
        $model = BlogCategory::findOne(['id' => $id]);

        $postData = \Yii::$app->request->post();

        if ($model->load($postData))
        {
            foreach (\Yii::$app->params['availableLanguages'] as $language)
            {
                $modelTranslation = BlogCategoryTranslation::findOne(['language_code' => $language, 'category_id' => $model->id]);
                $modelTranslation->setAttributes($postData['BlogCategoryTranslation'][$language]);

                $model->translationModels[$language] = $modelTranslation;
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    public function actionView($id)
    {
        $model = BlogCategory::findOne(['id' => $id]);

        return $this->render('view', [
            'model' => $model
        ]);
    }
}