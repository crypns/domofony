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
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id', 'complex_id', 'product_id', 'count', 'cost'], 'integer'],
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
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'complex_id' => $this->complex_id,
            'product_id' => $this->product_id,
            'count' => $this->count,
            'cost' => $this->cost,
        ]);

        return $dataProvider;
    }
}