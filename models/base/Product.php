<?php
// This class was automatically generated
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "products".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property string $image
 *
 * @property \app\models\CartProduct[] $cartProducts
 * @property \app\models\Cart[] $carts
 * @property \app\models\ComplexProduct[] $complexProducts
 * @property \app\models\Category $category
 * @property string $aliasModel
 */

abstract class Product extends \app\custom\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'image'], 'required'],
            [['category_id'], 'default', 'value' => null],
            [['category_id'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Category::className(), 'targetAttribute' => ['category_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'name' => Yii::t('models', 'Name'),
            'category_id' => Yii::t('models', 'Category ID'),
            'image' => Yii::t('models', 'Image'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(), [
            'name' => Yii::t('models', 'Название продукта'),
            'category_id' => Yii::t('models', 'Название категории'),
            'image' => Yii::t('models', 'Изображение'),
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
    public function getCarts()
    {
        return $this->hasMany(\app\models\Cart::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplexProducts()
    {
        return $this->hasMany(\app\models\ComplexProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(\app\models\Category::className(), ['id' => 'category_id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\query\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ProductQuery(get_called_class());
    }


}
