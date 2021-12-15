<?php

namespace app\models;

use Yii;
use \app\models\base\ApartmentComplex as BaseApartmentComplex;

/**
 * This is the model class for table "apartment_complexes".
 */
class ApartmentComplex extends BaseApartmentComplex
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
}
