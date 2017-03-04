<?php

namespace rgen3\blog\backend\controllers;

use rgen3\blog\common\models\BlogTag;
use rgen3\blog\common\models\BlogTagSearch;
use rgen3\blog\common\models\BlogTagTranslation;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TagController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new BlogTagSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new BlogTag();

        $postData = \Yii::$app->request->post();

        if ($model->load($postData))
        {
            foreach (\Yii::$app->params['availableLanguages'] as $language)
            {
                $modelTranslation = new BlogTagTranslation();
                $modelTranslation->setAttributes($postData['BlogTagTranslation'][$language]);
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
        $model = BlogTag::findOne(['id' => $id]);

        if (!$model)
        {
            throw new NotFoundHttpException(\Yii::t('app', 'Blog tag not found'));
        }

        $postData = \Yii::$app->request->post();

        if ($model->load($postData))
        {
            foreach (\Yii::$app->params['availableLanguages'] as $language)
            {
                $modelTranslation = $model->getTranslation($language);
                $modelTranslation->setAttributes($postData['BlogTagTranslation'][$language]);
                $model->translationModels[$language] = $modelTranslation;
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $model = BlogTag::findOne(['id' => $id]);

        if (!$model)
        {
            throw new NotFoundHttpException(\Yii::t('app', 'Blog category not found'));
        }

        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionSearch($term, $lang = null)
    {
        return Json::encode(['RUS', 'ENG']);
    }
}