<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Setting as SettingModel;

/**
* Setting represents the model behind the search form about `app\models\Setting`.
*/
class Setting extends SettingModel
{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['number_phone_1', 'number_phone_2', 'address', 'email', 'bot_token', 'chat_id', 'public_key', 'private_key', 'youtube_link', 'facebook_link', 'instagram_link', 'created_at', 'updated_at'], 'safe'],
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
        $query = SettingModel::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'number_phone_1', $this->number_phone_1])
            ->andFilterWhere(['ilike', 'number_phone_2', $this->number_phone_2])
            ->andFilterWhere(['ilike', 'address', $this->address])
            ->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'bot_token', $this->bot_token])
            ->andFilterWhere(['ilike', 'chat_id', $this->chat_id])
            ->andFilterWhere(['ilike', 'public_key', $this->public_key])
            ->andFilterWhere(['ilike', 'private_key', $this->private_key])
            ->andFilterWhere(['ilike', 'youtube_link', $this->youtube_link])
            ->andFilterWhere(['ilike', 'facebook_link', $this->facebook_link])
            ->andFilterWhere(['ilike', 'instagram_link', $this->instagram_link]);

        return $dataProvider;
    }
}