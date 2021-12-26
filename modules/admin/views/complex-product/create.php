<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\ComplexProduct $model
*/

$this->title = Yii::t('models', 'Complex Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Complex Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="complex-product-create">

    <h1>
        <?= Yii::t('models', 'Complex Product') ?>
        <small>
            <?= Html::encode($model->label) ?>
        </small>
    </h1>

    <?= $this->render('_form', [
        'model'=> $model,
    ]) ?>

</div>
