<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\PopularProduct $model
*/

$this->title = Yii::t('models', 'Popular Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Popular Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'Edit');
?>

<div class="popular-product-update">

    <h1>
        <?= Yii::t('models', 'Popular Product') ?>
        <small>
            <?= Html::encode($model->label) ?>
        </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a(
            Yii::t('cruds', 'View'), 
            ['view', 'id' => $model->id], 
            ['class' => 'btn btn-primary']) 
        ?>
    </div>
    <br>

    <?= $this->render('_form', [
        'model'=> $model,
    ]) ?>

</div>
