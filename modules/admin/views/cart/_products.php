<?php

use yii\helpers\Html;
use yii\bootstrap4\Tabs;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\CartProduct $searchModel
 *  @var app\models\Cart $model
 */

?>



<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'summary' => false,
    'showFooter' => true,
    'footerRowOptions'=>['style'=>'font-weight:bold;'],
    'columns' => [
        [
            'class' => yii\grid\DataColumn::className(),
            'label' => Yii::t('cruds', 'Product'),
            'value' => function ($model) {
                if ($rel = $model->complexProduct->product) {
                    return Html::a($rel->name, ['product/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                } else {
                    return '';
                }
            },
            'format' => 'raw',
        ],
        [
            'class' => yii\grid\DataColumn::className(),
            'label' => Yii::t('cruds', 'Category'),
            'value' => function ($model) {
                if ($rel = $model->complexProduct->product->category) {
                    return Html::a($rel->name, ['category/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                } else {
                    return '';
                }
            },
            'format' => 'raw',
        ],
        [
            'class' => app\custom\ImgColumn::className(),
            'attribute' => 'complexProduct.product.image',
            'filter' => false,
        ],
        [
            'attribute' => 'cost',
            'format' => 'currency',
            'value' => 'complexProduct.cost',
            'footer' => 'Итого: ',
        ],
        [
            'attribute' => 'count',
            'format' => 'integer',
            'filter' => false,
            'footer' => $model->general_count . ' шт.',
        ],
        [
            'attribute' => 'total_price',
            'format' => 'currency',
            'value' => function($model) {
                return $model->count * $model->complexProduct->cost;

            },
            'footer' => Yii::$app->formatter->asCurrency($model->general_cost),
        ],
    ]
]); ?>