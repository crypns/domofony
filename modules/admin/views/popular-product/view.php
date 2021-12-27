<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\helpers\StringHelper;

/**
* @var yii\web\View $this
* @var app\models\PopularProduct $model
*/
$copyParams = $model->attributes;

$this->title = Yii::t('models', 'Popular Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Popular Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'View');
?>
<div class="popular-product-view">


    <h1>
        <?= Yii::t('models', 'Popular Product') ?>
        <small>
            <?= Html::encode($model->label) ?>
        </small>
    </h1>


    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?= Html::a(
            '<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('cruds', 'Edit'),
            [ 'update', 'id' => $model->id],
            ['class' => 'btn btn-info']) ?>

            <?= Html::a(
            '<span class="glyphicon glyphicon-copy"></span> ' . Yii::t('cruds', 'Copy'),
            ['create', 'id' => $model->id],
            ['class' => 'btn btn-success']) ?>

            <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New'),
            ['create'],
            ['class' => 'btn btn-success']) ?>
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> '
            . Yii::t('cruds', 'Full list'), ['index'], ['class'=>'btn btn-primary']) ?>
        </div>

    </div>

    <hr/>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
            'name',
        'product_code',
        'description',
        [
            'attribute' => 'image',
            'value' => $model->getFilePathByAttribute(),
            'format' => ['image', ['height' => '300px']],
        ],
        [
            'attribute' => 'product_link',
            'format' => 'raw',
            'value' => Html::a(StringHelper::truncate($model->product_link,100), $model->product_link, ['target' => '_blank']),
        ],
    ],
    ]); ?>

    <hr/>

    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('cruds', 'Delete'), ['delete', 'id' => $model->id],
    [
    'class' => 'btn btn-danger',
    'data-confirm' => '' . Yii::t('cruds', 'Are you sure to delete this item?') . '',
    'data-method' => 'post',
    ]); ?>


</div>
