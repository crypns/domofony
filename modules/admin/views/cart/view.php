<?php

use yii\helpers\Html;
use yii\bootstrap4\Tabs;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\Cart $model
*/
$copyParams = $model->attributes;

$this->title = Yii::t('models', 'Cart');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Carts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'View');
?>
<div class="cart-view">


    <h1>
        <?= Yii::t('models', 'Cart') ?>
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
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> '
            . Yii::t('cruds', 'Full list'), ['index'], ['class'=>'btn btn-primary']) ?>
        </div>

    </div>

    <hr/>

    <?= Tabs::widget([
        'items' => [
            [
                'label'     =>  Yii::t('models', 'Customer'),
                'content'   =>  $this->renderAjax('_customer', [
                    'model' => $model,
                ]),
                'active'    =>  true
            ],
            [
                'label'     =>  Yii::t('models', 'Products'),
                'content'   =>  $this->renderAjax('_customer', [
                    'model' => $model,
                ]),
            ],
        ]
    ]); ?>

    <hr/>

    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('cruds', 'Delete'), ['delete', 'id' => $model->id],
    [
    'class' => 'btn btn-danger',
    'data-confirm' => '' . Yii::t('cruds', 'Are you sure to delete this item?') . '',
    'data-method' => 'post',
    ]); ?>


</div>
