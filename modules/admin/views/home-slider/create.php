<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\HomeSlider $model
*/

$this->title = Yii::t('models', 'Home Slider');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Home Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="home-slider-create">

    <h1>
        <?= Yii::t('models', 'Home Slider') ?>
        <small>
            <?= Html::encode($model->label) ?>
        </small>
    </h1>

    <?= $this->render('_form', [
        'model'=> $model,

        'isAjax' => false,
        'customPluginOptions' => [
            'showUpload' => false,
            'showCancel' => false,
        ],
    ]) ?>

</div>
