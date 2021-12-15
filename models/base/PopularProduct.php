<?php
// This class was automatically generated
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "popular_products".
 *
 * @property integer $id
 * @property string $name
 * @property string $product_code
 * @property string $description
 * @property string $image
 * @property string $product_link
 * @property string $aliasModel
 */

abstract class PopularProduct extends \app\custom\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'popular_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'product_code', 'description', 'image', 'product_link'], 'required'],
            [['name', 'product_code', 'description', 'image', 'product_link'], 'string', 'max' => 255]
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
            'product_code' => Yii::t('models', 'Product Code'),
            'description' => Yii::t('models', 'Description'),
            'image' => Yii::t('models', 'Image'),
            'product_link' => Yii::t('models', 'Product Link'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(), [
            'name' => Yii::t('models', 'Название товара'),
            'product_code' => Yii::t('models', 'Код товара'),
            'description' => Yii::t('models', 'Описание товара'),
            'image' => Yii::t('models', 'Изображение товара'),
            'product_link' => Yii::t('models', 'Ссылка на продукт'),
        ]);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\query\PopularProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\PopularProductQuery(get_called_class());
    }


}
