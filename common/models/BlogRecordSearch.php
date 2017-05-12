<?php

namespace rgen3\blog\common\models;

use yii\data\ActiveDataProvider;

class BlogRecordSearch extends BlogRecord
{
    public $limit = 10;
    public $page = null;
    public $category = null;
    public $orderBy = null;

    public function rules()
    {
        return [
            [['limit', 'page'], 'integer'],
            [['category'], 'each', 'rule' => ['string']],
            [['orderBy'], 'safe']
        ];
    }

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

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);


        $this->load($params);

        if (!$this->validate())
        {
            $query->where('1=0');
            return $dataProvider;
        }

        $dataProvider->pagination = [
            'pageSize' => $this->limit,
            'page' => $this->page
        ];

        if ($this->orderBy)
        {
            $query->orderBy($this->orderBy);
        }

        $query->filterWhere([
            'id' => $this->id
        ]);

        if ($this->category)
        {
            $query->join(' join ', BlogRecordToCategory::tableName(), 'id=record_id')
                ->onCondition(['category_id' => $this->category]);
        }

        return $dataProvider;
    }
}