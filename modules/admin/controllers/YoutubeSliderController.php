<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\HttpException;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\AccessControl;

use app\models\YoutubeSlider;
use app\models\search\YoutubeSlider as YoutubeSliderSearch;

/**
* YoutubeSliderController implements the CRUD actions for YoutubeSlider model.
*/
class YoutubeSliderController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['AppYoutubeSliderFull'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['AppYoutubeSliderView'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update', 'create', 'delete'],
                        'roles' => ['AppYoutubeSliderEdit'],
                    ],
                ],
            ],
        ];
    }


    /**
    * Lists all YoutubeSlider models.
    * @return mixed
    */
    public function actionIndex()
    {
        $searchModel  = new YoutubeSliderSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
    * Displays a single YoutubeSlider model.
    * @param integer $id
    *
    * @return mixed
    */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
    * Creates a new YoutubeSlider model.
    * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param $id int|null If copying model
     *
     * @return mixed
     */
    public function actionCreate(int $id = null)
    {
        $model = new YoutubeSlider();
        if ($id) {
            $originModel = YoutubeSlider::findOne($id);
            if (!$model->load($originModel->attributes, '')) {
                Yii::$app->session->addFlash('error', Yii::t('app', 'Failed to copy record.'));
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
    * Updates an existing YoutubeSlider model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        }
        
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
    * Deletes an existing YoutubeSlider model.
    * If deletion is successful, the browser will be redirected to the 'index' page.
    * @param integer $id
    * @return mixed
    */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        
        return $this->redirect('index');
    }

    /**
    * Finds the YoutubeSlider model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return YoutubeSlider the loaded model
    * @throws HttpException if the model cannot be found
    */
    protected function findModel($id)
    {
        if (($model = YoutubeSlider::findOne($id)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }
}
