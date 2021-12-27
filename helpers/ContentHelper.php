<?php

namespace app\helpers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Category;


class ContentHelper
{

    public static function getCategoriesForDropdown(string $firstProperty = 'id', string $secondProperty = 'name')
    {
        return ArrayHelper::map(Category::find()->all(), $firstProperty, function ($element) use ($secondProperty) {
            return str_repeat('- ', $element->depth) . $element->$secondProperty;
        });
    }

    public static function getKartikFilePreviewConfig(\app\custom\ActiveRecord $model, string $action = '/admin/file/delete')
    {
        $fileNameAttribute = $model::FILE_NAME_ATTRIBUTE;

        $filePath = Yii::getAlias($model::FILE_PATH).$model->$fileNameAttribute;
        $size = is_file($filePath) ? filesize($filePath) : '';
        return [
            'size' => $size,
            'url' => Yii::$app->urlManager->createUrl([
                $action,
                'id' => $model->id,
                'className' => $model::className(),
            ]),
        ];
    }

}