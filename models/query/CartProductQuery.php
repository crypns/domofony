<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\CartProduct]].
 *
 * @see \app\models\CartProduct
 */
class CartProductQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return \app\models\CartProduct[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\CartProduct|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
