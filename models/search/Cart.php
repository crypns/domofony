<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cart as CartModel;

/**
* Cart represents the model behind the search form about `app\models\Cart`.
*/
class Cart extends CartModel
{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id', 'product_id', 'general_cost', 'general_count'], 'integer'],
            [['full_name', 'phone_number', 'email', 'address', 'delivery', 'status_order'], 'safe'],
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
        $query = CartModel::find();

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
            'product_id' => $this->product_id,
            'general_cost' => $this->general_cost,
            'general_count' => $this->general_count,
        ]);

        $query->andFilterWhere(['ilike', 'full_name', $this->full_name])
            ->andFilterWhere(['ilike', 'phone_number', $this->phone_number])
            ->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'address', $this->address])
            ->andFilterWhere(['ilike', 'delivery', $this->delivery])
            ->andFilterWhere(['ilike', 'status_order', $this->status_order]);

        return $dataProvider;
    }
}