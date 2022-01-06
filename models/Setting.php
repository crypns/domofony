<?php

namespace app\models;

use Yii;
use \app\models\base\Setting as BaseSetting;

/**
 * This is the model class for table "settings".
 */
class Setting extends BaseSetting
{

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            # custom behaviors
        ]);
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            # custom validation rules
        ]);
    }

    public static function getValue(string $name)
    {
        return self::findOne(1)?->$name ?: '';
    }
}
