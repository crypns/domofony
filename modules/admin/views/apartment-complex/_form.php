<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\ApartmentComplex $model
*/
?>

<div class="apartment-complex-form">
    <?php $form = ActiveForm::begin([
        'id' => 'ApartmentComplex',
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


    <!-- attribute `name` -->
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <!-- end attribute -->
    <!-- attribute `address` -->
    <?= $form->field($model, 'address')->textArea(['maxlength' => true, 'rows'=>'3']) ?>
    <!-- end attribute -->
    <!-- attribute `description` -->
    <?= $form->field($model, 'description')->textArea(['maxlength' => true, 'rows'=>'4']) ?>
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
