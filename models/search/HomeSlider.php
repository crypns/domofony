<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HomeSlider as HomeSliderModel;

/**
* HomeSlider represents the model behind the search form about `app\models\HomeSlider`.
*/
class HomeSlider extends HomeSliderModel
{
    public $complex_name;

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'description', 'image', 'product_link', 'complex_name'], 'string'],
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
        $query = HomeSliderModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => [
                'name',
                'description',
                'image',
                'product_link',
                'complex_name' => [
                    'asc' => ['apartment_complexes.name' => SORT_ASC],
                    'desc' => ['apartment_complexes.name' => SORT_DESC],
                    'default' => SORT_DESC
                ],
            ],
        ]]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('complex');


        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['ilike', 'home_sliders.name', $this->name])
            ->andFilterWhere(['ilike', 'home_sliders.description', $this->description])
            ->andFilterWhere(['ilike', 'image', $this->image])
            ->andFilterWhere(['ilike', 'product_link', $this->product_link]);

        if (preg_match("|$this->complex_name|ui", 'На главной') && $this->complex_name) {
            $query->andWhere(['apartment_complexes.name' => null]);
        } else {
            $query->andFilterWhere(['ilike', 'apartment_complexes.name', $this->complex_name]);
        }

        return $dataProvider;
    }
}