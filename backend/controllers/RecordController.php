<?php

namespace rgen3\blog\backend\controllers;

use rgen3\blog\common\models\BlogCategory;
use rgen3\blog\common\models\BlogRecord;
use rgen3\blog\common\models\BlogRecordSearch;
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

        if ($model->load(\Yii::$app->request->post()))
        {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionUpdate()
    {}

    public function actionDelete()
    {}
}