<?php
// This class was automatically generated
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "source_message".
 *
 * @property integer $id
 * @property string $category
 * @property string $message
 *
 * @property \app\models\Message[] $messages
 * @property string $aliasModel
 */

abstract class SourceMessage extends \app\custom\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'source_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['category'], 'string', 'max' => 32],
            [['message'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'category' => Yii::t('models', 'Category'),
            'message' => Yii::t('models', 'Message'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(\app\models\Message::className(), ['source_id' => 'id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\query\SourceMessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\SourceMessageQuery(get_called_class());
    }


}
