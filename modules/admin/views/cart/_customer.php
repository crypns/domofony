<?php

use yii\helpers\Html;
use yii\bootstrap4\Tabs;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Cart $model
 */

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'full_name',
        'phone_number',
        'email:email',
        'address',
        'delivery',
        [
            'attribute'  => 'general_count',
            'value'  => function ($model, $widget) {
                return $model->general_count . ' шт.';
            },
        ],
        [
            'attribute'  => 'general_cost',
            'value'  => function ($model, $widget) {
                return Yii::$app->formatter->asCurrency($model->general_cost);
            },
        ],
        'status_order',
    ],
]); ?>
