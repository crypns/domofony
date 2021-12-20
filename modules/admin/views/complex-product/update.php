<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\ComplexProduct $model
*/

$this->title = Yii::t('models', 'Complex Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Complex Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'Edit');
?>

<div class="complex-product-update">

    <h1>
        <?= Yii::t('models', 'Complex Product') ?>
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


    <div class="complex-product-form">
        <?php $form = ActiveForm::begin([
            'id' => 'ComplexProduct',
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

                
			<!-- attribute `complex_id` -->
			<?= // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::activeField
$form->field($model, 'complex_id')->dropDownList(
    \yii\helpers\ArrayHelper::map(app\models\ApartmentComplex::find()->all(), 'id', 'name'),
    [
        'prompt' => Yii::t('cruds', 'Select'),
        'disabled' => (isset($relAttributes) && isset($relAttributes['complex_id'])),
    ]
); ?>
			<!-- end attribute -->
			<!-- attribute `product_id` -->
			<?= // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::activeField
$form->field($model, 'product_id')->dropDownList(
    \yii\helpers\ArrayHelper::map(app\models\Product::find()->all(), 'id', 'name'),
    [
        'prompt' => Yii::t('cruds', 'Select'),
        'disabled' => (isset($relAttributes) && isset($relAttributes['product_id'])),
    ]
); ?>
			<!-- end attribute -->
			<!-- attribute `count` -->
			<?= $form->field($model, 'count')->textInput() ?>
			<!-- end attribute -->
			<!-- attribute `cost` -->
			<?= $form->field($model, 'cost')->textInput() ?>
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
