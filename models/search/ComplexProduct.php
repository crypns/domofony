<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ComplexProduct as ComplexProductModel;

/**
 * ComplexProduct represents the model behind the search form about `app\models\ComplexProduct`.
 */
class ComplexProduct extends ComplexProductModel
{
    public $complex_name;
    public $product_name;
    public $from_count;
    public $to_count;
    public $from_cost;
    public $to_cost;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'count', 'cost'], 'integer'],
            [['from_count', 'to_count', 'from_cost', 'to_cost'], 'double'],
            [['complex_name', 'product_name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return parent::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ComplexProductModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => [
                'complex_name' => [
                    'asc' => ['apartment_complexes.name' => SORT_ASC],
                    'desc' => ['apartment_complexes.name' => SORT_DESC],
                    'default' => SORT_DESC
                ],
                'product_name' => [
                    'asc' => ['products.name' => SORT_ASC],
                    'desc' => ['products.name' => SORT_DESC],
                    'default' => SORT_DESC
                ],
                'count',
                'cost',
            ],
        ]]);


        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('complex');
        $query->joinWith('product');

        $query->andFilterWhere([
            'id' => $this->id,
            'count' => $this->count,
            'cost' => $this->cost,
        ]);

        $query->andFilterWhere(['AND',
            ['>=', 'count', $this->from_count],
            ['<=', 'count', $this->to_count],
        ]);

        $query->andFilterWhere(['AND',
            ['>=', 'cost', $this->from_cost],
            ['<=', 'cost', $this->to_cost],
        ]);

        $query->andFilterWhere(['ilike', 'apartment_complexes.name', $this->complex_name])
        ->andFilterWhere(['ilike', 'products.name', $this->product_name]);
        return $dataProvider;
    }
}