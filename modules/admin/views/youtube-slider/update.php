<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\YoutubeSlider $model
*/

$this->title = Yii::t('models', 'Youtube Slider');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Youtube Slider'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'Edit');
?>

        <?= $this->render('_form', [
            'model'=> $model,
        ]) ?>

</div>
