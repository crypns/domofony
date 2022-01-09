<?php
// This class was automatically generated
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "apartment_complexes".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \app\models\ComplexProduct[] $complexProducts
 * @property \app\models\HomeSlider[] $homeSliders
 * @property string $aliasModel
 */

abstract class ApartmentComplex extends \app\custom\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'apartment_complexes';
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
            [['name', 'address', 'description'], 'required'],
            [['name', 'address'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1024],
            [['name'], 'unique']
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
            'address' => Yii::t('models', 'Address'),
            'description' => Yii::t('models', 'Description'),
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
            'name' => Yii::t('models', 'Название ЖК'),
            'address' => Yii::t('models', 'Адрес ЖК'),
            'description' => Yii::t('models', 'Описание ЖК'),
            'created_at' => Yii::t('models', 'Дата создания записи'),
            'updated_at' => Yii::t('models', 'Дата редактирования записи'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplexProducts()
    {
        return $this->hasMany(\app\models\ComplexProduct::className(), ['complex_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHomeSliders()
    {
        return $this->hasMany(\app\models\HomeSlider::className(), ['complex_id' => 'id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\query\ApartmentComplexQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ApartmentComplexQuery(get_called_class());
    }


}
