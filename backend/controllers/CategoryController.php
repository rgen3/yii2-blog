<?php

namespace rgen3\blog\backend\controllers;

use rgen3\blog\common\models\BlogCategorySearch;
use yii\web\Controller;

class CategoryController extends Controller
{
    public function actionIndex()
    {
        \Yii::$app->language = 'ru';

        $searchModel = new BlogCategorySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new BlogCategorySearch();

        if ($model->load(\Yii::$app->request->post()))
        {
            var_dump(\Yii::$app->request->post());die();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }
}