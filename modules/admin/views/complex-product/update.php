<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\ComplexProduct $model
*/

$this->title = Yii::t('models', 'Complex Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Complex Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'Edit');
?>

<div class="complex-product-update">

    <h1>
        <?= Yii::t('models', 'Complex Product') ?>
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
