<?php

namespace rgen3\blog\backend\controllers;

use rgen3\blog\common\models\BlogCategory;
use rgen3\blog\common\models\BlogRecord;
use rgen3\blog\common\models\BlogRecordSearch;
use rgen3\blog\common\models\BlogRecordTranslation;
use yii\web\Controller;

class RecordController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new BlogRecordSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new BlogRecord();

        $postData = \Yii::$app->request->post();

        if ($model->load($postData))
        {
            foreach (\Yii::$app->params['availableLanguages'] as $language)
            {
                $modelTranslation = new BlogRecordTranslation();
                $modelTranslation->setAttributes($postData['BlogRecordTranslation'][$language]);
                $model->translationModels[$language] = $modelTranslation;
            }

            $model->save();
            $model->saveCategories();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => new BlogCategory()
        ]);
    }

    public function actionView($id)
    {
        $model = BlogRecord::findOne(['id' => $id]);

        if (!$model)
        {
            throw new NotFoundHttpException(\Yii::t('app', 'Blog category not found'));
        }

        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id)
    {
        $model = BlogRecord::findOne(['id' => $id]);

        if (!$model)
        {
            throw new NotFoundHttpException(\Yii::t('app', 'Blog category not found'));
        }

        $postData = \Yii::$app->request->post();

        if ($model->load($postData))
        {
            foreach (\Yii::$app->params['availableLanguages'] as $language)
            {
                $modelTranslation = $model->getTranslation($language);
                $modelTranslation->setAttributes($postData['BlogRecordTranslation'][$language]);
                $model->translationModels[$language] = $modelTranslation;
            }

            $model->save();
            $model->saveCategories();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => new BlogCategory()
        ]);
    }

    public function actionDelete($id)
    {
        $record = BlogRecord::findOne(['id' => $id]);

        $record && $record->remove();

        return $this->redirect(['index']);
    }
}