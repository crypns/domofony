<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\PopularProduct]].
 *
 * @see \app\models\PopularProduct
 */
class PopularProductQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return \app\models\PopularProduct[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\PopularProduct|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
