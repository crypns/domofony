<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Message as MessageModel;

/**
* Message represents the model behind the search form about `app\models\Message`.
*/
class Message extends MessageModel
{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id', 'source_id'], 'integer'],
            [['language', 'translation'], 'safe'],
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
        $query = MessageModel::find();

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
            'source_id' => $this->source_id,
        ]);

        $query->andFilterWhere(['ilike', 'language', $this->language])
            ->andFilterWhere(['ilike', 'translation', $this->translation]);

        return $dataProvider;
    }
}