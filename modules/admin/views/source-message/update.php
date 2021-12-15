<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\SourceMessage $model
*/

$this->title = Yii::t('models', 'Source Message');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Source Message'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'Edit');
?>

<div class="source-message-update">

    <h1>
        <?= Yii::t('models', 'Source Message') ?>
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


    <div class="source-message-form">
        <?php $form = ActiveForm::begin([
            'id' => 'SourceMessage',
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

                
			<!-- attribute `message` -->
			<?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>
			<!-- end attribute -->
			<!-- attribute `category` -->
			<?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>
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
