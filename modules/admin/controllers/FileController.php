<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\HttpException;
use yii\web\UploadedFile;
use yii\helpers\StringHelper;
use yii\helpers\Json;
use yii\db\ActiveRecord;

use app\helpers\FileHelper;
use app\models\Product;
use app\models\ProductPhoto;


class FileController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['upload', 'delete', 'delete-without-model'],
                        'roles' => ['moderator'],
                    ],
                    // [
                    // TODO set role
                    // ],
                ],
            ],
        ];
    }

    // public function actionUpload()
    // {
    //     $post = Yii::$app->request->post();
    //     $modelParams = json_decode($post['modelInitParams'], 1);
    //     $className = $post['className'];
    //     $baseClassName = StringHelper::basename($className);

    //     $files = UploadedFile::getInstancesByName($baseClassName);

    //     if (isset($files[0])) {
    //         $file = $files[0];

    //         return $this->uploadImageToModel($model, $file);
    //     }

    //     return true;
    // }

    public function actionUpload()
    {
        $post = Yii::$app->request->post();
        $modelAttributes = json_decode($post['modelInitAttributes'], 1);
        $className = $post['className'];

        $baseClassName = StringHelper::basename($className);
        $files = UploadedFile::getInstancesByName($baseClassName);

        $model = isset($post['id']) ? $className::findModel($post['id']) : new $className();
        $returnDeleteUrl = isset($post['deleteUrl']) ? $post['deleteUrl'] : '/admin/file/delete';

        foreach ($modelAttributes as $key => $value) {
            $model->$key = $value;
        }

        if (isset($files[0])) {
            $file = $files[0];

            return $this->uploadImageToModel($model, $file, $returnDeleteUrl);
        }

        return true;
    }


    public function actionDelete($id, $className)
    {
        $className = urldecode($className);

        $model = $className::findModel($id);
        return $model->delete();
    }

    public function actionDeleteWithoutModel($id, $className)
    {
        $className = urldecode($className);
        $model = $className::findModel($id);


        $fileNameAttribute = $model::FILE_NAME_ATTRIBUTE;
        $flag = FileHelper::deleteModelFile($model, $model::FILE_PATH, $fileNameAttribute);
        $model->$fileNameAttribute = null;

        if ($flag || $model->save(false)) {
            return true;
        }

        return Json::encode([
            'error' => Yii::t('cruds', 'Image was not deleted, please try again later')
        ]);
    }



    private function uploadImageToModel(ActiveRecord $model, UploadedFile $file, string $returnDeleteUrl)
    {
        $fileAttribute = $model::UPLOAD_FILE_ATTRIBUTE;
        $model->$fileAttribute = $file;

        $preview = [];
        $config = [];
        $error = '';
        if ($model->saveWithFiles()) {
            $preview = Yii::getAlias($model->getFilePathByAttribute());
            $config[] = $this->getConfigToReturn($model, $file, $returnDeleteUrl);
        } else {
            $error = Yii::t('cruds', 'Image not uploaded, please try again later.');
        }

        $out = [
            'initialPreview' => $preview,
            'initialPreviewConfig' => $config,
            'initialPreviewAsData' => true,
            'error' => $error,
        ];

        return Json::encode($out);
    }

    private function getConfigToReturn(ActiveRecord $model, UploadedFile $file, string $returnDeleteUrl)
    {
        return [
            'key' => $model->id,
            'size' => $file->size,
            'url' => Yii::$app->urlManager->createUrl([
                $returnDeleteUrl,
                'id' => $model->id,
                'className' => $model::className(),
            ])
        ];
    }

}