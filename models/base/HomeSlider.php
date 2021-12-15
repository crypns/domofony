<?php
// This class was automatically generated
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "home_sliders".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string $product_link
 * @property integer $complex_id
 *
 * @property \app\models\ApartmentComplex $complex
 * @property string $aliasModel
 */

abstract class HomeSlider extends \app\custom\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'home_sliders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'image', 'product_link'], 'required'],
            [['complex_id'], 'default', 'value' => null],
            [['complex_id'], 'integer'],
            [['name', 'description', 'image', 'product_link'], 'string', 'max' => 255],
            [['complex_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\ApartmentComplex::className(), 'targetAttribute' => ['complex_id' => 'id']]
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
            'description' => Yii::t('models', 'Description'),
            'image' => Yii::t('models', 'Image'),
            'product_link' => Yii::t('models', 'Product Link'),
            'complex_id' => Yii::t('models', 'Complex ID'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(), [
            'name' => Yii::t('models', 'Заголовок слайдера'),
            'description' => Yii::t('models', 'Описание слайдера'),
            'image' => Yii::t('models', 'Изображение'),
            'product_link' => Yii::t('models', 'Ссылка на продукт'),
            'complex_id' => Yii::t('models', 'Название ЖК'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplex()
    {
        return $this->hasOne(\app\models\ApartmentComplex::className(), ['id' => 'complex_id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\query\HomeSliderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\HomeSliderQuery(get_called_class());
    }


}
