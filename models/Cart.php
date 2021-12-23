<?php

namespace app\models;

use Yii;
use \app\models\base\Cart as BaseCart;

/**
 * This is the model class for table "carts".
 */
class Cart extends BaseCart
{

    public $street;
    public $house;
    public $apartment;
    public $entrance;
    public $floor;
    public $code_post;

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            # custom behaviors
        ]);
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['street', 'house', 'apartment', 'entrance', 'floor'], 'required'],
            [['address'], 'filter', 'filter' => function($value) {

                $result = $this->street
                    . ', д.  ' . $this->house
                    . ', кв. ' . $this->apartment
                    . ', подъезд ' . $this->entrance
                    . ', этаж ' . $this->floor;
                return $result;

            }],
        ]);
    }
}
