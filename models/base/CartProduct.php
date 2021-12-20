<?php
// This class was automatically generated
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "cart_products".
 *
 * @property integer $id
 * @property integer $cart_id
 * @property integer $product_id
 * @property integer $count
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \app\models\Cart $cart
 * @property \app\models\ComplexProduct $product
 * @property string $aliasModel
 */

abstract class CartProduct extends \app\custom\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_products';
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
            [['cart_id', 'product_id', 'count'], 'required'],
            [['cart_id', 'product_id', 'count'], 'default', 'value' => null],
            [['cart_id', 'product_id', 'count'], 'integer'],
            [['cart_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Cart::className(), 'targetAttribute' => ['cart_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\ComplexProduct::className(), 'targetAttribute' => ['product_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'cart_id' => Yii::t('models', 'Cart ID'),
            'product_id' => Yii::t('models', 'Product ID'),
            'count' => Yii::t('models', 'Count'),
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
            'product_id' => Yii::t('models', 'Название товара'),
            'count' => Yii::t('models', 'Количество товара'),
            'created_at' => Yii::t('models', 'Дата создания записи'),
            'updated_at' => Yii::t('models', 'Дата редактирования записи'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCart()
    {
        return $this->hasOne(\app\models\Cart::className(), ['id' => 'cart_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(\app\models\ComplexProduct::className(), ['id' => 'product_id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\query\CartProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CartProductQuery(get_called_class());
    }


}
