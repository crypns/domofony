<?php
// This class was automatically generated
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "complex_products".
 *
 * @property integer $id
 * @property integer $complex_id
 * @property integer $product_id
 * @property integer $count
 * @property string $cost
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \app\models\CartProduct[] $cartProducts
 * @property \app\models\ApartmentComplex $complex
 * @property \app\models\Product $product
 * @property string $aliasModel
 */

abstract class ComplexProduct extends \app\custom\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complex_products';
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
            [['complex_id', 'product_id', 'cost'], 'required'],
            [['complex_id', 'product_id', 'count'], 'default', 'value' => null],
            [['complex_id', 'product_id', 'count'], 'integer'],
            [['cost'], 'number'],
            [['complex_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\ApartmentComplex::className(), 'targetAttribute' => ['complex_id' => 'id']],
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
            'complex_id' => Yii::t('models', 'Complex ID'),
            'product_id' => Yii::t('models', 'Product ID'),
            'count' => Yii::t('models', 'Count'),
            'cost' => Yii::t('models', 'Cost'),
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
            'complex_id' => Yii::t('models', 'Название ЖК'),
            'product_id' => Yii::t('models', 'Название товара'),
            'count' => Yii::t('models', 'Количество товара'),
            'cost' => Yii::t('models', 'Стоимость товара'),
            'created_at' => Yii::t('models', 'Дата создания записи'),
            'updated_at' => Yii::t('models', 'Дата редактирования записи'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartProducts()
    {
        return $this->hasMany(\app\models\CartProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplex()
    {
        return $this->hasOne(\app\models\ApartmentComplex::className(), ['id' => 'complex_id']);
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
     * @return \app\models\query\ComplexProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ComplexProductQuery(get_called_class());
    }


}
