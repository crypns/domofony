<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\HttpException;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\AccessControl;

use app\models\Cart;
use app\models\search\Cart as CartSearch;
use app\models\CartProduct;
use app\models\search\CartProduct as CartProductSearch;

/**
* CartController implements the CRUD actions for Cart model.
*/
class CartController extends \yii\web\Controller
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
                        'roles' => ['AppCartFull'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['AppCartView'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update', 'create', 'delete'],
                        'roles' => ['AppCartEdit'],
                    ],
                ],
            ],
        ];
    }


    /**
    * Lists all Cart models.
    * @return mixed
    */
    public function actionIndex()
    {
        $searchModel  = new CartSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
    * Displays a single Cart model.
    * @param integer $id
    *
    * @return mixed
    */
    public function actionView($id)
    {
        $cartModelSearchProduct  = new CartProductSearch;

        $get = Yii::$app->request->queryParams;
        $get['CartProduct']['cart_id'] = $get['id'];
        $dataProvider = $cartModelSearchProduct->search($get);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'cartModelSearchProduct' => $cartModelSearchProduct,
        ]);
    }

    /**
    * Updates an existing Cart model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = $model::SCENARIO_ADMIN_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
    * Deletes an existing Cart model.
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
    * Finds the Cart model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return Cart the loaded model
    * @throws HttpException if the model cannot be found
    */
    protected function findModel($id)
    {
        if (($model = Cart::findOne($id)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }
}
