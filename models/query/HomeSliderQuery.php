<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\HomeSlider]].
 *
 * @see \app\models\HomeSlider
 */
class HomeSliderQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return \app\models\HomeSlider[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\HomeSlider|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
