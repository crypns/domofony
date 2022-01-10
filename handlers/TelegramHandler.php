<?php

namespace app\handlers;

use Yii;
use aki\telegram\Telegram;
use aki\telegram\base\Command;
use app\models\Cart;
use app\models\Setting;


class TelegramHandler {

    public static function messagePaymentConfirmed(Cart $cartModel)
    {
        $message = 'Заказ №' . $cartModel->id  . 'оплачен.';

        return self::sendMessage($message);
    }

    public static function sendMessageCartFormed(Cart $cartModel)
    {
        $message = 'Номер заказа: ' . $cartModel->id . "\r\n"
            . 'Имя: ' . $cartModel->full_name . "\r\n"
            . 'Номер телефона: ' . $cartModel->phone_number . "\r\n"
            . 'Email: ' . $cartModel->email . "\r\n"
            . 'Общая стоимость заказа: ' . Yii::$app->formatter->asCurrency($cartModel->general_cost) . "\r\n"
            . Yii::$app->urlManager->createAbsoluteUrl(['admin/cart/view', 'id' => $cartModel->id]);

        return self::sendMessage($message);
    }

    public static function sendMessage(string $message)
    {
        Yii::$app->telegram->botToken = Setting::getValue('bot_token');
        return Yii::$app->telegram->sendMessage([
            'chat_id' => Setting::getValue('chat_id'),
            'text' => $message,
        ]);
    }
}
