<?php

namespace app\models;

use Yii;
use \app\models\base\Cart as BaseCart;
use yii\helpers\html;

/**
 * This is the model class for table "carts".
 */
class Cart extends BaseCart
{
    const STATUS_NEW = 'New';
    const STATUS_PROCESSING = 'Processing';
    const STATUS_CANCELED = 'Canceled';
    const STATUS_PAYED = 'Payed';
    const STATUS_DONE = 'Done';

    const SCENARIO_ADMIN_UPDATE = 'When updaiting by admin';

    const DELIVERY_NOVA = 'Нова Пошта';
    const DELIVERY_COUR = 'Кур’єр';

    const STATUSES = [
        self::STATUS_NEW => 'New',
        self::STATUS_PROCESSING => 'Processing',
        self::STATUS_CANCELED => 'Canceled',
        self::STATUS_PAYED => 'Payed',
        self::STATUS_DONE => 'Done',
    ];

    public $first_name;
    public $last_name;
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
        return array_merge([
            ['email', 'email'],
            ['phone_number', \borales\extensions\phoneInput\PhoneInputValidator::className()],
            [['street', 'house', 'apartment', 'entrance', 'floor'], 'required', 'except' => self::SCENARIO_ADMIN_UPDATE],
            [['address'], 'filter', 'filter' => function($value_address) {
                if ($this->address) {
                    return $this->address;
                }
                $result_address = $this->street
                    . ', д.  ' . $this->house
                    . ', кв. ' . $this->apartment
                    . ', подъезд ' . $this->entrance
                    . ', этаж ' . $this->floor;
                return $result_address;
            }],
            [['first_name', 'last_name'], 'required', 'except' => self::SCENARIO_ADMIN_UPDATE],
            [['full_name'], 'filter', 'filter' => function($value_name) {
                if ($this->full_name) {
                    return $this->full_name;
                }
                $result_name = $this->first_name
                    . ' ' . $this->last_name;
                return  $result_name;
            }],
            ['status_order', 'default', 'value' => 'New'],

            [['code_post'], 'required',
                'when' => function ($model) {
                    return $model->delivery == Cart::DELIVERY_NOVA;
                 },
                'whenClient' => 'function(attribute, value) {
                    return $("#' . Html::getInputId($this, 'delivery') . '").val()=="'. Cart::DELIVERY_NOVA .'";
                }',
            ],
            [['delivery'], 'filter', 'filter' => function($value_delivery) {
                if ($this->delivery == Cart::DELIVERY_NOVA) {

                    return $this->delivery . ' Номер отделения: ' . $this->code_post;
                }
                return $this->delivery;
            }],
        ], parent::rules());
    }
    public function getLabel()
    {
        return $this->full_name;
    }

    public function getComplexProducts()
    {
        return $this->hasMany(\app\models\ComplexProduct::className(), ['id' => 'product_id'])
            ->viaTable(\app\models\CartProduct::tableName(), ['cart_id' => 'id']);
    }
}
