<?php

namespace rgen3\blog\common\models;

use rgen3\blog\common\models\BlogTagTranslation;
use yii\data\ActiveDataProvider;

class BlogTagSearch extends BlogTag
{
    public function search($params)
    {
        $query = BlogTag::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);

        if (!$this->validate())
        {
            $query->where('1=0');
            return $dataProvider;
        }

        return $dataProvider;
    }
}