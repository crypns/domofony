<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Cart]].
 *
 * @see \app\models\Cart
 */
class CartQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return \app\models\Cart[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Cart|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
