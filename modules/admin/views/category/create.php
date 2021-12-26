<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\Category $model
*/

$this->title = Yii::t('models', 'Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="category-create">

    <h1>
        <?= Yii::t('models', 'Category') ?>
        <small>
            <?= Html::encode($model->label) ?>
        </small>
    </h1>

    <?= $this->render('_form', [
        'model'=> $model,
    ]) ?>

</div>
