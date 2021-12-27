<?php

namespace app\custom;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;


class ImgColumn extends \yii\grid\DataColumn {

    public $value;
    public $format = 'html';


    /**
     * Returns the data cell value.
     * @param mixed $model the data model
     * @param mixed $key the key associated with the data model
     * @param int $index the zero-based index of the data model among the models array returned by [[GridView::dataProvider]].
     * @return string the data cell value
     */
    public function getDataCellValue($model, $key, $index)
    {
        if ($this->value !== null) {
            if (is_string($this->value)) {
                return ArrayHelper::getValue($model, $this->value);
            }

            return call_user_func($this->value, $model, $key, $index, $this);
        } else {
            return $this->defaultValue($model, $key, $index, $this);
        }

        // return ArrayHelper::getValue($model, $this->attribute);
        return null;
    }


    public function defaultValue($model, $key, $index, $column)
    {
        $url = ArrayHelper::getValue($model, $column->attribute);

        $relationsAndAttribute = StringHelper::explode($column->attribute, '.');

        $buffer = $model;
        $lastModel =  $model;
        foreach ($relationsAndAttribute as $relationOrValueName) {
            if ($buffer) {
                $buffer = $buffer->$relationOrValueName;
            } else {
                $lastModel = null;
                break;
            }

            if (next($relationsAndAttribute)) {
                $lastModel = $buffer;
            }
        }
        $attributeValue = $buffer;
        // dd($attributeValue);
        // dd($lastModel);

        if ($lastModel) {
            // dd($attributeValue);
            // dd($lastModel);
            if ($path = $lastModel->getFilePathByUrl($attributeValue)) {
                // if ($path = $model->getFilePathByUrl($url)) {
                return Html::img($path, [
                    'style' => [
                        'max-height' => '200px',
                    ],
                ]);
            }
        }
        return null;
    }

}