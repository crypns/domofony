<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\SourceMessage]].
 *
 * @see \app\models\SourceMessage
 */
class SourceMessageQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return \app\models\SourceMessage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\SourceMessage|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
