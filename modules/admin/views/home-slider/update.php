<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\HomeSlider $model
*/

$this->title = Yii::t('models', 'Home Slider');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Home Slider'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'Edit');
?>

<div class="home-slider-update">

    <h1>
        <?= Yii::t('models', 'Home Slider') ?>
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

        'isAjax' => true,

        'uploadUrl' => Url::to(['/admin/file/upload']),
        'deleteUrl' => Url::to(['/admin/file/delete-without-model']),

        'uploadExtraData' => [
            'id' => $model->id,
            'className' => $model::className(),
            'deleteUrl' => '/admin/file/delete-without-model',

            'modelInitAttributes' => json_encode([
            ]),
        ],
        'customPluginOptions' => [
            'showCancel' => false,
        ],
    ]) ?>

</div>
