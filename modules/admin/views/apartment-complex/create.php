<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\ApartmentComplex $model
*/

$this->title = Yii::t('models', 'Apartment Complex');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Apartment Complex'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="apartment-complex-create">

    <h1>
        <?= Yii::t('models', 'Apartment Complex') ?>
        <small>
            <?= Html::encode($model->label) ?>
        </small>
    </h1>

    <?= $this->render('_form', [
        'model'=> $model,
    ]) ?>

</div>
