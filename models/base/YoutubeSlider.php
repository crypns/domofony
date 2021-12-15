<?php
// This class was automatically generated
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "youtube_sliders".
 *
 * @property integer $id
 * @property string $name
 * @property string $youtube_link
 * @property string $aliasModel
 */

abstract class YoutubeSlider extends \app\custom\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'youtube_sliders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['youtube_link'], 'required'],
            [['name', 'youtube_link'], 'string', 'max' => 255]
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
            'youtube_link' => Yii::t('models', 'Youtube Link'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(), [
            'name' => Yii::t('models', 'Название видео'),
            'youtube_link' => Yii::t('models', 'Ссылка на видео ютуб'),
        ]);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\query\YoutubeSliderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\YoutubeSliderQuery(get_called_class());
    }


}
