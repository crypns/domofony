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
    public $from_general_cost;
    public $to_general_cost;
    public $from_general_count;
    public $to_general_count;
    public $from_created_at;
    public $to_created_at;

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id', 'general_cost', 'general_count'], 'integer'],
            [['from_general_count', 'to_general_count', 'from_general_cost', 'to_general_cost'], 'double'],
            [['from_created_at', 'to_created_at'], 'string'],
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
            'general_cost' => $this->general_cost,
            'general_count' => $this->general_count,
        ]);

        $query->andFilterWhere(['AND',
            ['>=', 'general_cost', $this->from_general_cost],
            ['<=', 'general_cost', $this->to_general_cost],
        ]);
        $query->andFilterWhere(['AND',
            ['>=', 'general_count', $this->from_general_count],
            ['<=', 'general_count', $this->to_general_count],
        ]);
        $query->andFilterWhere(['AND',
            ['>=', 'created_at', $this->from_created_at],
            ['<=', 'created_at', $this->to_created_at],
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