<?php

namespace app\helpers;

use Yii;
use yii\web\UploadedFile;


class FileHelper {

    public static function getPairsOfTranslations()
    {
        $mainCategory = Yii::$app->id;
        $mainTranslateLanguage = Yii::$app->language;

        $ua_pairs = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'message' . DIRECTORY_SEPARATOR . $mainTranslateLanguage . DIRECTORY_SEPARATOR . $mainCategory . '.php';

        $allLanguagesPairs = array_merge_recursive($ua_pairs);

        return $allLanguagesPairs;
    }

    public static function saveOrUpdateFile(\yii\db\ActiveRecord $model, string $folderAlias, string $fileNameAttribute, string $uploadFileAttribute)
    {
        $folder = self::getFolderPathWithCheck($folderAlias);

        // Unset old file
        self::deleteModelFile($model, $folder, $fileNameAttribute);

        if (!$model->$uploadFileAttribute instanceof UploadedFile) {
            $model->$uploadFileAttribute = UploadedFile::getInstance($model, $uploadFileAttribute);
        }
        if ($model->$uploadFileAttribute) {
            $model->$fileNameAttribute = Yii::$app->security->generateRandomString() . '.' . $model->$uploadFileAttribute->extension;

            if ($model->$uploadFileAttribute->saveAs($folder . $model->$fileNameAttribute, false)) {
                return true;
            }
        }

        return null;
    }

    /**
     * Delete main model file by given attribute
     *
     * @param $model \yii\db\ActiveRecord
     * @param $folder str
     * @param $fileNameAttribute str
     */
    public static function deleteModelFile(\yii\db\ActiveRecord $model, string $folderAlias, string $fileNameAttribute)
    {
        if (isset($model->oldAttributes[$fileNameAttribute])) {
            if ($model->oldAttributes[$fileNameAttribute] != null) {
                $oldPath = self::getFolderPathWithCheck($folderAlias) . $model->oldAttributes[$fileNameAttribute];

                return self::deleteFile($oldPath);
            }
        }
        return false;
    }

    /**
     * Gets the folder asias & create it if it doesnt exists
     *
     * @param $path str
     *
     * @return str Alias of folder
     */
    public static function getFolderPathWithCheck(string $folderAlias)
    {
        $path = Yii::getAlias($folderAlias);
        if (!is_dir($path)) {
            mkdir($path);
        }
        return $path;
    }

    /**
     * Delete file with checking
     *
     * @param $path str
     *
     * @return bool
     */
    public static function deleteFile(string $path)
    {
        if (file_exists($path)) {
            return unlink($path);
        }
        return false;
    }
}