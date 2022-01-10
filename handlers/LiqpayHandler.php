<?php

namespace app\handlers;

use Yii;
use dicr\liqpay\LiqPayModule;
use app\models\Cart;
use app\models\Setting;


class LiqpayHandler {

    public static function createPayment(Cart $cartModel)
    {
        /** @var LiqPayModule $liqpay получаем модуль */
        $liqpay = Yii::$app->getModule('liqpay');
        $liqpay->publicKey = Setting::getValue('public_key');
        $liqpay->privateKey = Setting::getValue('private_key');
        dd($liqpay);
        $liqpay->
        // создаем запрос платежа
        $request = $liqpay->checkoutRequest([
            'returnUrl' => Yii::$app->urlManager->createAbsoluteUrl('/site/index'),
            'orderId' => $cartModel->id,
            'amount' => $cartModel->general_cost,
            'description' => 'Оплата заказа №' . $cartModel->id,
        ]);
        //Yii::$app->urlManager->createAbsoluteUrl('/site/success'),
        // переадресуем клиента на страницу оплаты
        return $request->redirect();
    }
}