<?php
// This class was automatically generated
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "settings".
 *
 * @property integer $id
 * @property string $number_phone_1
 * @property string $number_phone_2
 * @property string $address
 * @property string $email
 * @property string $bot_token
 * @property string $chat_id
 * @property string $public_key
 * @property string $private_key
 * @property string $youtube_link
 * @property string $facebook_link
 * @property string $instagram_link
 * @property string $created_at
 * @property string $updated_at
 * @property string $aliasModel
 */

abstract class Setting extends \app\custom\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
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
            [['number_phone_1', 'number_phone_2', 'address', 'email', 'bot_token', 'chat_id', 'public_key', 'private_key', 'youtube_link', 'facebook_link', 'instagram_link'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'number_phone_1' => Yii::t('models', 'Number Phone 1'),
            'number_phone_2' => Yii::t('models', 'Number Phone 2'),
            'address' => Yii::t('models', 'Address'),
            'email' => Yii::t('models', 'Email'),
            'bot_token' => Yii::t('models', 'Bot Token'),
            'chat_id' => Yii::t('models', 'Chat ID'),
            'public_key' => Yii::t('models', 'Public Key'),
            'private_key' => Yii::t('models', 'Private Key'),
            'youtube_link' => Yii::t('models', 'Youtube Link'),
            'facebook_link' => Yii::t('models', 'Facebook Link'),
            'instagram_link' => Yii::t('models', 'Instagram Link'),
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
            'number_phone_1' => Yii::t('models', 'Номер телефона 1'),
            'number_phone_2' => Yii::t('models', 'Номер телефона 2'),
            'address' => Yii::t('models', 'Адрес'),
            'email' => Yii::t('models', 'Почта'),
            'bot_token' => Yii::t('models', 'Telegram token bot'),
            'chat_id' => Yii::t('models', 'Telegram chat id'),
            'public_key' => Yii::t('models', 'Public key liqpay'),
            'private_key' => Yii::t('models', 'Private key liqpay'),
            'youtube_link' => Yii::t('models', 'Youtube link'),
            'facebook_link' => Yii::t('models', 'Facebook link'),
            'instagram_link' => Yii::t('models', 'Instagram link'),
            'created_at' => Yii::t('models', 'Дата создания записи'),
            'updated_at' => Yii::t('models', 'Дата редактирования записи'),
        ]);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\query\SettingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\SettingQuery(get_called_class());
    }


}
