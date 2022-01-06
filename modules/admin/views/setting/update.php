<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\Setting $model
*/

$this->title = Yii::t('models', 'Setting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Setting'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'Edit');
?>

<div class="setting-update">

    <h1>
        <?= Yii::t('models', 'Setting') ?>
        <small>
            <?= Html::encode($model->id) ?>
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


    <div class="setting-form">
        <?php $form = ActiveForm::begin([
            'id' => 'Setting',
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

                
			<!-- attribute `number_phone_1` -->
			<?= $form->field($model, 'number_phone_1')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `number_phone_2` -->
			<?= $form->field($model, 'number_phone_2')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `address` -->
			<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `email` -->
			<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `bot_token` -->
			<?= $form->field($model, 'bot_token')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `chat_id` -->
			<?= $form->field($model, 'chat_id')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `public_key` -->
			<?= $form->field($model, 'public_key')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `private_key` -->
			<?= $form->field($model, 'private_key')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `youtube_link` -->
			<?= $form->field($model, 'youtube_link')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `facebook_link` -->
			<?= $form->field($model, 'facebook_link')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `instagram_link` -->
			<?= $form->field($model, 'instagram_link')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
            
            <?= Html::submitButton(
                Yii::t('cruds', 'Save'),
                [
                    'id' => 'save-' . $model->formName(),
                    'class' => 'btn btn-success'
                ]
            ); ?>

        <?php ActiveForm::end(); ?>
    </div>



</div>
