<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\ComplexProduct]].
 *
 * @see \app\models\ComplexProduct
 */
class ComplexProductQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return \app\models\ComplexProduct[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ComplexProduct|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
