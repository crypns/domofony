<?php

namespace app\modules\admin\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;

class Menu extends Widget
{
    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();

        $menu = [
            Yii::t('cruds', 'Test') => [
                [
                    'name' => Yii::t('app', 'Test'),
                    'url' => Url::to(['default/index']),
                    'can' => Yii::$app->user->can('test'),
                ],
            ],
            Yii::t('cruds', 'Without group') => [
                [
                    'name' => Yii::t('models', 'Apartment Complexes'),
                    'url' => Url::to(['apartment-complex/index']),
                    'can' => Yii::$app->user->can('app_apartment-complex_index'),              
                ],
                [
                    'name' => Yii::t('models', 'Cart Products'),
                    'url' => Url::to(['cart-product/index']),
                    'can' => Yii::$app->user->can('app_cart-product_index'),              
                ],
                [
                    'name' => Yii::t('models', 'Carts'),
                    'url' => Url::to(['cart/index']),
                    'can' => Yii::$app->user->can('app_cart_index'),              
                ],
                [
                    'name' => Yii::t('models', 'Categories'),
                    'url' => Url::to(['category/index']),
                    'can' => Yii::$app->user->can('app_category_index'),              
                ],
                [
                    'name' => Yii::t('models', 'Complex Products'),
                    'url' => Url::to(['complex-product/index']),
                    'can' => Yii::$app->user->can('app_complex-product_index'),              
                ],
                [
                    'name' => Yii::t('models', 'Home Sliders'),
                    'url' => Url::to(['home-slider/index']),
                    'can' => Yii::$app->user->can('app_home-slider_index'),              
                ],
                [
                    'name' => Yii::t('models', 'Message'),
                    'url' => Url::to(['message/index']),
                    'can' => Yii::$app->user->can('app_message_index'),              
                ],
                [
                    'name' => Yii::t('models', 'Popular Products'),
                    'url' => Url::to(['popular-product/index']),
                    'can' => Yii::$app->user->can('app_popular-product_index'),              
                ],
                [
                    'name' => Yii::t('models', 'Products'),
                    'url' => Url::to(['product/index']),
                    'can' => Yii::$app->user->can('app_product_index'),              
                ],
                [
                    'name' => Yii::t('models', 'Source Message'),
                    'url' => Url::to(['source-message/index']),
                    'can' => Yii::$app->user->can('app_source-message_index'),              
                ],
                [
                    'name' => Yii::t('models', 'Youtube Sliders'),
                    'url' => Url::to(['youtube-slider/index']),
                    'can' => Yii::$app->user->can('app_youtube-slider_index'),              
                ],
            ],
        ];
        
        return $this->render('menu', [
            'content' => $content,
            'menu' => $menu,
        ]);
    }
}
