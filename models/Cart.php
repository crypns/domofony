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
            ['address', 'filter', 'filter' => function($value) {
            dd(123);
                $value = $this->house
                    . ', ' . $this->street
                    . ', ' . $this->apartment
                    . ', ' . $this->entrance
                    . ', ' . $this->floor;
              //  dd($value);
                dump($value);
                dump($this);
                die;
                return $value;

            }],
        ]);

    }
}
