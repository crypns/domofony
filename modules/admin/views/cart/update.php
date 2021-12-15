<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\Cart $model
*/

$this->title = Yii::t('models', 'Cart');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Cart'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'Edit');
?>

<div class="cart-update">

    <h1>
        <?= Yii::t('models', 'Cart') ?>
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


    <div class="cart-form">
        <?php $form = ActiveForm::begin([
            'id' => 'Cart',
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

                
			<!-- attribute `product_id` -->
			<?= // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::activeField
$form->field($model, 'product_id')->dropDownList(
    \yii\helpers\ArrayHelper::map(app\models\Product::find()->all(), 'id', 'label'),
    [
        'prompt' => Yii::t('cruds', 'Select'),
        'disabled' => (isset($relAttributes) && isset($relAttributes['product_id'])),
    ]
); ?>
			<!-- end attribute -->
			<!-- attribute `full_name` -->
			<?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `phone_number` -->
			<?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `email` -->
			<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `address` -->
			<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `delivery` -->
			<?= $form->field($model, 'delivery')->textInput(['maxlength' => true]) ?>
			<!-- end attribute -->
			<!-- attribute `general_cost` -->
			<?= $form->field($model, 'general_cost')->textInput() ?>
			<!-- end attribute -->
			<!-- attribute `general_count` -->
			<?= $form->field($model, 'general_count')->textInput() ?>
			<!-- end attribute -->
			<!-- attribute `status_order` -->
			<?= $form->field($model, 'status_order')->textInput(['maxlength' => true]) ?>
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
