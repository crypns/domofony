<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\search\Category $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'GET',
    ]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'name') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('cruds', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('cruds', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
