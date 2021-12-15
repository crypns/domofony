<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Message]].
 *
 * @see \app\models\Message
 */
class MessageQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return \app\models\Message[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Message|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
