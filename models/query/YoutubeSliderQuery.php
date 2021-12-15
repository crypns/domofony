<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\YoutubeSlider]].
 *
 * @see \app\models\YoutubeSlider
 */
class YoutubeSliderQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return \app\models\YoutubeSlider[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\YoutubeSlider|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
