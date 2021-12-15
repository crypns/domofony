<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;

/**
* @var yii\web\View $this
* @var app\models\HomeSlider $model
*/
$copyParams = $model->attributes;

$this->title = Yii::t('models', 'Home Slider');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Home Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'View');
?>
<div class="home-slider-view">


    <h1>
        <?= Yii::t('models', 'Home Slider') ?>
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
        'description',
        'image',
        'product_link',
// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::attributeFormat
[
    'format' => 'html',
    'attribute' => 'complex_id',
    'value' => ($model->complex ? 
        Html::a('<i class="glyphicon glyphicon-list"></i>', ['apartment-complex/index']).' '.
        Html::a('<i class="glyphicon glyphicon-circle-arrow-right"></i> '.$model->complex->label, ['apartment-complex/view', 'id' => $model->complex->id,]).' '.
        Html::a('<i class="glyphicon glyphicon-paperclip"></i>', ['create', 'HomeSlider'=>['complex_id' => $model->complex_id]])
        : 
        '<span class="label label-warning">?</span>'),
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
