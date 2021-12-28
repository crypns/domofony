<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CartProduct as CartProductModel;

/**
* CartProduct represents the model behind the search form about `app\models\CartProduct`.
*/
class CartProduct extends ComplexProduct
{
    public $cart_id;

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['cart_id'], 'integer'],
        ]);
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
    public function search($params, $query = null)
    {
        $this->load($params);
        $cartModel = Cart::findModel($this->cart_id);
        $query = $cartModel
            ->getCartProducts()
//            ->getComplexProducts()
            ->with('complexProduct.product.category');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//            'sort' => ['attributes' => [
//                'complex_product.product.name',
//                'complex_product.product.category_name' => [
//                    'asc' => ['categories.name' => SORT_ASC],
//                    'desc' => ['categories.name' => SORT_DESC],
//                    'default' => SORT_DESC
//                ],
//            ],
//        ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}