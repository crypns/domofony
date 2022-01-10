<?php
// This class was automatically generated
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "carts".
 *
 * @property integer $id
 * @property string $full_name
 * @property string $phone_number
 * @property string $email
 * @property string $address
 * @property string $delivery
 * @property string $general_cost
 * @property integer $general_count
 * @property string $status_order
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \app\models\CartProduct[] $cartProducts
 * @property string $aliasModel
 */

abstract class Cart extends \app\custom\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carts';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => function ($event) {
                    return date("Y-m-d H:i:s");
                }
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name', 'phone_number', 'email', 'address', 'delivery', 'general_cost', 'general_count', 'status_order'], 'required'],
            [['general_cost'], 'number'],
            [['general_count'], 'default', 'value' => null],
            [['general_count'], 'integer'],
            [['full_name', 'phone_number', 'email', 'address', 'delivery', 'status_order'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'full_name' => Yii::t('models', 'Full Name'),
            'phone_number' => Yii::t('models', 'Phone Number'),
            'email' => Yii::t('models', 'Email'),
            'address' => Yii::t('models', 'Address'),
            'delivery' => Yii::t('models', 'Delivery'),
            'general_cost' => Yii::t('models', 'General Cost'),
            'general_count' => Yii::t('models', 'General Count'),
            'status_order' => Yii::t('models', 'Status Order'),
            'created_at' => Yii::t('models', 'Created At'),
            'updated_at' => Yii::t('models', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(), [
            'full_name' => Yii::t('models', 'ФИО'),
            'phone_number' => Yii::t('models', 'Номер телефона'),
            'email' => Yii::t('models', 'Электронная почта'),
            'address' => Yii::t('models', 'Адрес'),
            'delivery' => Yii::t('models', 'Способ доставки'),
            'general_cost' => Yii::t('models', 'Общая стоимость товара'),
            'general_count' => Yii::t('models', 'Общее количество товара'),
            'status_order' => Yii::t('models', 'Статус заказа'),
            'created_at' => Yii::t('models', 'Дата создания записи'),
            'updated_at' => Yii::t('models', 'Дата редактирования записи'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartProducts()
    {
        return $this->hasMany(\app\models\CartProduct::className(), ['cart_id' => 'id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\query\CartQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CartQuery(get_called_class());
    }


}
