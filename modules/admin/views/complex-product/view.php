<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;

/**
* @var yii\web\View $this
* @var app\models\ComplexProduct $model
*/
$copyParams = $model->attributes;

$this->title = Yii::t('models', 'Complex Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Complex Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'View');
?>
<div class="complex-product-view">


    <h1>
        <?= Yii::t('models', 'Complex Product') ?>
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
    // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::attributeFormat
        [
            'format' => 'html',
            'attribute' => 'complex_id',
            'value' => ($model->complex ?
                Html::a('<i class="glyphicon glyphicon-list"></i>', ['apartment-complex/index']).' '.
                Html::a('<i class="glyphicon glyphicon-circle-arrow-right"></i> '.$model->complex->name, ['apartment-complex/view', 'id' => $model->complex->id,]).' '.
                Html::a('<i class="glyphicon glyphicon-paperclip"></i>', ['create', 'ComplexProduct'=>['complex_id' => $model->complex_id]])
                :
                '<span class="label label-warning">?</span>'),
        ],
// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::attributeFormat
        [
            'format' => 'html',
            'attribute' => 'product_id',
            'value' => ($model->product ?
                Html::a('<i class="glyphicon glyphicon-list"></i>', ['product/index']).' '.
                Html::a('<i class="glyphicon glyphicon-circle-arrow-right"></i> '.$model->product->name, ['product/view', 'id' => $model->product->id,]).' '.
                Html::a('<i class="glyphicon glyphicon-paperclip"></i>', ['create', 'ComplexProduct'=>['product_id' => $model->product_id]])
                :
                '<span class="label label-warning">?</span>'),
        ],
        [
            'attribute'  => 'count',
            'value'  => function ($model, $widget) {
                return $model->count . ' шт.';
            },
        ],
        [
                'attribute'  => 'cost',
                'value'  => function ($model, $widget) {
                    return Yii::$app->formatter->asCurrency($model->cost);
                },
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
