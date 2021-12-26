<?php

namespace app\models;

use Yii;
use \app\models\base\Category as BaseCategory;

/**
 * This is the model class for table "categories".
 */
class Category extends BaseCategory
{
    public function beforeDelete()
    {
        $products = Product::find()->where(['category_id' => $this->id])->all();
        if (!empty($products)) {
            Yii::$app->session->setFlash(
                'warning',
                'Нельзя удалить категорию, содержащию товары'
            );
            return false;
        }
        return parent::beforeDelete();
    }
    // Use this method to set primary name column if it has not standart name
    public function getLabel()
    {
        // return $this->full_name;
    }

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
}
