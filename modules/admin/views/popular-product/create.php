<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\PopularProduct $model
*/

$this->title = Yii::t('models', 'Popular Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Popular Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="popular-product-create">

    <h1>
        <?= Yii::t('models', 'Popular Product') ?>
        <small>
            <?= Html::encode($model->label) ?>
        </small>
    </h1>

    <?= $this->render('_form', [
        'model'=> $model,
    ]) ?>

</div>
