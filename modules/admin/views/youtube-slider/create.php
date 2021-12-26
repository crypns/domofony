<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\YoutubeSlider $model
*/

$this->title = Yii::t('models', 'Youtube Slider');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Youtube Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="youtube-slider-create">

    <h1>
        <?= Yii::t('models', 'Youtube Slider') ?>
        <small>
            <?= Html::encode($model->label) ?>
        </small>
    </h1>

    <?= $this->render('_form', [
        'model'=> $model,
    ]) ?>

</div>
