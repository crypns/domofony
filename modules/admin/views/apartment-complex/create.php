<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\ApartmentComplex $model
*/

$this->title = Yii::t('models', 'Apartment Complex');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Apartment Complexes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="apartment-complex-create">

    <h1>
        <?= Yii::t('models', 'Apartment Complex') ?>
        <small>
            <?= Html::encode($model->label) ?>
        </small>
    </h1>


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
			<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `description` -->
			<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
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
