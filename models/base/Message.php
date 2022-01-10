<?php
// This class was automatically generated
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "message".
 *
 * @property integer $id
 * @property integer $source_id
 * @property string $language
 * @property string $translation
 *
 * @property \app\models\SourceMessage $source
 * @property string $aliasModel
 */

abstract class Message extends \app\custom\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['source_id'], 'default', 'value' => null],
            [['source_id'], 'integer'],
            [['translation'], 'string'],
            [['language'], 'string', 'max' => 255],
            [['source_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\SourceMessage::className(), 'targetAttribute' => ['source_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'source_id' => Yii::t('models', 'Source ID'),
            'language' => Yii::t('models', 'Language'),
            'translation' => Yii::t('models', 'Translation'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(\app\models\SourceMessage::className(), ['id' => 'source_id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\query\MessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\MessageQuery(get_called_class());
    }


}
