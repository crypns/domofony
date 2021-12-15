<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\ApartmentComplex]].
 *
 * @see \app\models\ApartmentComplex
 */
class ApartmentComplexQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return \app\models\ApartmentComplex[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ApartmentComplex|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
