<?php

namespace rgen3\blog\common\models;

use yii\data\ActiveDataProvider;

class BlogCategorySearch extends BlogCategory
{
    public function search($params)
    {
        $query = BlogCategory::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);
        
        if (!$this->validate())
        {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->filterWhere([
            'id' => $this->id
        ]);

        return $dataProvider;
    }
}
