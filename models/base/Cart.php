<?php
// This class was automatically generated
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "carts".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $full_name
 * @property string $phone_number
 * @property string $email
 * @property string $address
 * @property string $delivery
 * @property integer $general_cost
 * @property integer $general_count
 * @property string $status_order
 *
 * @property \app\models\CartProduct[] $cartProducts
 * @property \app\models\Product $product
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
    public function rules()
    {
        return [
            [['product_id', 'full_name', 'phone_number', 'email', 'address', 'delivery', 'general_cost', 'general_count', 'status_order'], 'required'],
            [['product_id', 'general_cost', 'general_count'], 'default', 'value' => null],
            [['product_id', 'general_cost', 'general_count'], 'integer'],
            [['full_name', 'phone_number', 'email', 'address', 'delivery', 'status_order'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Product::className(), 'targetAttribute' => ['product_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'product_id' => Yii::t('models', 'Product ID'),
            'full_name' => Yii::t('models', 'Full Name'),
            'phone_number' => Yii::t('models', 'Phone Number'),
            'email' => Yii::t('models', 'Email'),
            'address' => Yii::t('models', 'Address'),
            'delivery' => Yii::t('models', 'Delivery'),
            'general_cost' => Yii::t('models', 'General Cost'),
            'general_count' => Yii::t('models', 'General Count'),
            'status_order' => Yii::t('models', 'Status Order'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(), [
            'product_id' => Yii::t('models', 'Название товара'),
            'full_name' => Yii::t('models', 'ФИО'),
            'phone_number' => Yii::t('models', 'Номер телефона'),
            'email' => Yii::t('models', 'Электронная почта'),
            'address' => Yii::t('models', 'Адрес'),
            'delivery' => Yii::t('models', 'Способ доставки'),
            'general_cost' => Yii::t('models', 'Общая стоимость товара'),
            'general_count' => Yii::t('models', 'Общее количество товара'),
            'status_order' => Yii::t('models', 'Статус заказа'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(\app\models\Product::className(), ['id' => 'product_id']);
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
