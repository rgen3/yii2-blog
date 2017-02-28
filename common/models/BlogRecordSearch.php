<?php

namespace rgen3\blog\common\models;

use yii\data\ActiveDataProvider;

class BlogRecordSearch extends BlogRecord
{
    protected $limit = 10;
    protected $page = null;
    /**
     * 'limit' => $this->limit,
    'offset' => $this->offset,
    'category' => $this->prepareCategory(),
    'sort'
     */
    /**
     * @param array $params
     * (
     * @type int $limit
     * @type int $offset
     * @type array $category
     * @type array $sort
     * )
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = BlogRecord::find();

        if (isset($params['limit']))
        {
            $this->limit = $params['limit'];
        }

        if (isset($params['page']))
        {
            $this->page = $params['page'];
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $this->limit,
                'page' => $this->page
            ]
        ]);

        if (isset($params['orderBy']))
        {
            $query->orderBy($params['orderBy']);
        }

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