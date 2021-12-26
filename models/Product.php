<?php

namespace app\models;

use Yii;
use \app\models\base\Product as BaseProduct;

/**
 * This is the model class for table "products".
 */
class Product extends BaseProduct
{
    public function beforeDelete()
    {
        $flag = true;
        foreach ($this->complexProducts as $complexProductModel) {
            $flag &= $complexProductModel->delete();
        }

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
            # custom validation rules
        ]);
    }
}
