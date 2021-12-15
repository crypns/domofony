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


    <div class="youtube-slider-form">
        <?php $form = ActiveForm::begin([
            'id' => 'YoutubeSlider',
            'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-danger',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    //'offset' => 'col-sm-offset-4',
                    'wrapper' => 'col-sm-8',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]); ?>

                
			<!-- attribute `youtube_link` -->
			<?= $form->field($model, 'youtube_link')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `name` -->
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
            
            <?= Html::submitButton(
                Yii::t('cruds', 'Create'),
                [
                    'id' => 'save-' . $model->formName(),
                    'class' => 'btn btn-success'
                ]
            ); ?>

        <?php ActiveForm::end(); ?>
    </div>

</div>
