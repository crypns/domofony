<?php

namespace app\controllers;

use app\handlers\LiqpayHandler;
use app\models\ApartmentComplex;
use app\models\CartProduct;
use app\models\ComplexProduct;
use app\models\HomeSlider;
use app\models\PopularProduct;
use app\models\YoutubeSlider;
use app\widgets\Header;
use http\Url;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use app\models\Cart;
use app\models\Setting;
use app\handlers\TelegramHandler;

class OrderController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $session = Yii::$app->session;
        $orders = $session->get('orders');

        $complexProductArrays = [];
        if ($orders) {
            foreach ($orders as $productID => $count) {
                $complexProductArrays[] = [
                    'object' => ComplexProduct::findOne($productID),
                    'count' => $count,
                ];
            }
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

        if ($post = Yii::$app->request->post()) {
            if ($cartModel->load($post) && $cartModel->save()) {
                foreach ($post['CartProduct'] as $cartProductData) {
                    $cartProductData['cart_id'] = $cartModel->id;
                    $cartProduct = new CartProduct([
                        'product_id' => $cartProductData['product_id'],
                        'count' => $cartProductData['count'],
                        'cart_id' => $cartProductData['cart_id'],
                    ]);
                    $cartProduct->save();
                }

                TelegramHandler::sendMessageCartFormed($cartModel);

                return LiqpayHandler::createPayment($cartModel);

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
