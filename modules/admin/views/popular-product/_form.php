<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var app\models\PopularProduct $model
 */
?>

<div class="popular-product-form">
    <?php $form = ActiveForm::begin([
        'id' => 'PopularProduct',
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
    <!-- attribute `product_code` -->
    <?= $form->field($model, 'product_code')->textarea(['maxlength' => true, 'rows' => '3']) ?>
    <!-- end attribute -->
    <!-- attribute `description` -->
    <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows' => '3']) ?>
    <!-- end attribute -->
    <!-- attribute `photo` -->
    <?= \app\widgets\FileInput::widget([
        'form' => $form,
        'model' => $model,
        'fileAttribute' => $model::UPLOAD_FILE_ATTRIBUTE,
        'multiple' => false,
        'allowedFileExtensions' => ['jpg', 'jpeg', 'gif', 'png'],
        'uploadExtraData' => isset($uploadExtraData) ? $uploadExtraData : [],

        'initialPreview' => $model->getFilePathByAttribute(),
        'initialPreviewConfig' => $model->getInititalPhotoPreviewConfig(),

        'isAjax' => $isAjax,

        'uploadUrl' => isset($uploadUrl) ? $uploadUrl : '',
        'deleteUrl' => isset($deleteUrl) ? $deleteUrl : '',

        'customOptions' => [],
        'customPluginOptions' => $customPluginOptions,
    ]); ?>
    <!-- attribute `product_link` -->
    <?= $form->field($model, 'product_link')->textInput(['maxlength' => true]) ?>
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
