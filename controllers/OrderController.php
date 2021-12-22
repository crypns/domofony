<?php

namespace app\controllers;

use app\models\ApartmentComplex;
use app\models\CartProduct;
use app\models\ComplexProduct;
use app\models\HomeSlider;
use app\models\PopularProduct;
use app\models\YoutubeSlider;
use app\widgets\Header;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use app\models\default\LoginForm;
use app\models\default\ContactForm;
use app\models\default\SignupForm;
use app\models\default\VerifyEmailForm;
use app\models\default\PasswordResetRequestForm;
use app\models\default\ResendVerificationEmailForm;
use app\models\default\ResetPasswordForm;
use app\models\Cart;


class OrderController extends Controller
{

    public function actionIndex()
    {
        $session = Yii::$app->session;
        $orders = $session->get('orders');

        $complexProductArrays = [];
        foreach ($orders as $productID => $count) {
            $complexProductArrays[] = [
                'object' => ComplexProduct::findOne($productID),
                'count' => $count,
            ];
        }

        $productCounter = 0;
        $productSum = 0;

        $cartProducts = [];
        foreach ($complexProductArrays as $complexProductArray) {
            $complexProduct = $complexProductArray['object'];
            $count = $complexProductArray['count'];

            if ($complexProduct) {
                $cartProducts[] = new CartProduct([
                    'product_id' => $complexProduct->id,
                    'count' => $count,
                ]);
                $productCounter += $count;


                $productSum += $complexProduct->cost * $count;


            }
        }
        $cartModel = new Cart([
            'general_cost' => $productSum,
            'general_count' => $productCounter,
        ]);
//dd($productSum);

        if ($cartModel->load(Yii::$app->request->post())) {
            if ($cartModel->load(Yii::$app->request->post()) && $cartModel->save(false)) {
                $this->redirect('order/success');

            }
        }


        return $this->render('index', [
            'products' => $complexProductArrays,
            'cartProducts' => $cartProducts,
            'cartModel' => $cartModel,
        ]);

    }
    public function actionSuccess()
    {
        return $this->render('/site/success');
    }

}