<?php

namespace app\models;

use Yii;
use \app\models\base\CartProduct as BaseCartProduct;

/**
 * This is the model class for table "cart_products".
 */
class CartProduct extends BaseCartProduct
{

    // Use this method to set primary name column if it has not standart name
    public function getLabel()
    {
        // return $this->full_name;
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            # custom behaviors
        ]);
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            # custom validation rules
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplexProduct()
    {
        return $this->hasOne(\app\models\ComplexProduct::className(), ['id' => 'product_id']);
    }
}
