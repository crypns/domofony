<?php

namespace app\modules\admin\controllers\api;

/**
* This is the class for REST controller "SettingController".
*/
use yii\filters\AccessControl;

use app\models\Setting;

class SettingController extends \app\custom\BaseApiController
{
    public $modelClass = Setting::class;

    /**
    * @inheritdoc
    */
    protected function accessRules()
    {
        return [
            'class' => \yii\filters\AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'matchCallback' => function ($rule, $action) {
                        $permissionName = $this->module->id . '_' . \yii\helpers\StringHelper::basename($this->id) . '_' . $action->id;
                        
                        return \Yii::$app->user->can($permissionName, ['route' => true]);
                    },
                ],
                [
                    'allow' => true,
                    'matchCallback' => function ($rule, $action) {
                        $permissionName = $this->module->id . '_' . \yii\helpers\StringHelper::basename($this->id);
                        $permissionName = \yii\helpers\Inflector::camelize($permissionName) . 'Full';
                        
                        return \Yii::$app->user->can($permissionName, ['route' => true]);
                    },
                ],
            ]
        ];
    }

    /**
    * @inheritdoc
    */
    protected function getAuthExceptActions()
    {
        return array_merge(parent::getAuthExceptActions(), [
        ]);
    }

    /**
    * @inheritdoc
    */
    protected function getAuthOnlyActions()
    {
        return array_merge(parent::getAuthOnlyActions(), [
            'create',
            'update',
            'delete',
        ]);
    }


    /**
     * Return list of models
     *
     * @param $size int size of returned data
     *
     * @return array Models
     */
    public function actionIndex(int $size = 50, int $offset = 0)
    {
        $models = $this->modelClass::find()
            ->offset($offset)
            ->limit($size)
            ->all();

        return $models;
    }

    /**
     * Creates new $this->modelClass
     *
     * @param id int
     * @param 
     *
     * @throws \yii\web\UnprocessableEntityHttpException (HTTP 422) When model not saved
     *
     * @return $this->modelClass
     */
    public function actionCreate()
    {
        $model = new $this->modelClass();
        $attributes = Yii::$app->getRequest()->getBodyParams();

        return $this->updateModel($model, $attributes, 201);
    }

    /**
     * Updates $this->modelClass
     *
     * @param id int
     * @param 
     *
     * @throws \yii\web\UnprocessableEntityHttpException (HTTP 422) When model not saved
     *
     * @return $this->modelClass
     */
    public function actionUpdate(int $id)
    {
        $model = $this->modelClass::findModel($id);
        $attributes = Yii::$app->getRequest()->getBodyParams();

        return $this->updateModel($model, $attributes, 201);
    }

    /**
     * Deletes the $this->modelClass by id
     *
     * @param $id int
     *
     * @throws \yii\web\BadRequestException When model deleting failed
     * @throws \yii\web\NotFoundHttpException When model not found
     *
     * @return bool
     */
    public function actionDelete(int $id)
    {
        if ($model = $this->modelClass::findOne($id)) {
            if (!$model->delete()) {
                throw new \yii\web\BadRequestException();
            }
            return true;
        }

        throw new \yii\web\NotFoundHttpException();
    }

}
