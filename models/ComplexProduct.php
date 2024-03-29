<?php

namespace app\models;

use Yii;
use \app\models\base\ComplexProduct as BaseComplexProduct;

/**
 * This is the model class for table "complex_products".
 */
class ComplexProduct extends BaseComplexProduct
{

    public function beforeDelete()
    {
        $flag = true;
        foreach ($this->cartProducts as $cartProductModel) {
            $flag &= $cartProductModel->delete();
        }
        Yii::$app->session->setFlash(
            'success',
            "Товар та пов'язані з ним дані були видалені успішно."
        );
        return $flag && parent::beforeDelete();
    }

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
            ['product_id', 'unique', 'targetAttribute' => ['product_id', 'complex_id'], 'message' => 'Даний ЖК вже має обраний товар'],
        ]);
    }
}
