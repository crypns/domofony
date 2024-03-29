<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\widgets\Alert;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var app\models\search\Category $searchModel
*/

$this->title = Yii::t('models', 'Categories');
$this->params['breadcrumbs'][] = $this->title;

/**
* create action column template depending acces rights
*/
$actionColumnTemplates = [];

if (\Yii::$app->user->can('app_category_view', ['route' => true])) {
    $actionColumnTemplates[] = '{view}';
}

if (\Yii::$app->user->can('app_category_update', ['route' => true])) {
    $actionColumnTemplates[] = '{update}';
}

if (\Yii::$app->user->can('app_category_delete', ['route' => true])) {
    $actionColumnTemplates[] = '{delete}';
}
if (isset($actionColumnTemplates)) {
    $actionColumnTemplateString = implode(' ', $actionColumnTemplates);
} else {
    Yii::$app->view->params['pageButtons'] = Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New'), ['create'], ['class' => 'btn btn-success']);
    $actionColumnTemplateString = "{view} {update} {delete}";
}
$actionColumnTemplateString = '<div class="action-buttons">'.$actionColumnTemplateString.'</div>';
?>

<div class="category-index">

    <?//= $this->render('_search', ['model' =>$searchModel]); ?>

    <h1>
        <?= Yii::t('models', 'Categories') ?>
        <small>
            <?= Yii::t('cruds', 'List') ?>        </small>
    </h1>
<!--    --><?php //if (Yii::$app->session->hasFlash('warning')): ?>
<!--        <div class="alert alert-warning alert-dismissible" role="alert">-->
<!--            <button type="button" class="close"-->
<!--                    data-dismiss="alert" aria-label="Закрыть">-->
<!--                <span aria-hidden="true">&times;</span>-->
<!--            </button>-->
<!--            <p>--><?//= Yii::$app->session->getFlash('warning'); ?><!--</p>-->
<!--        </div>-->
<!--    --><?php //endif; ?>
    <div class="clearfix crud-navigation">
		<?php if(\Yii::$app->user->can('app_category_create', ['route' => true])): ?>
            <div class="pull-left">
                <?= Html::a(
                    Yii::t('cruds', 'New'), 
                    ['create'], 
                    ['class' => 'btn btn-success']) 
                ?>
            </div>
		<?php endif; ?>
    </div>

    <div class="table-responsive">

        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'pager' => [
                'class' => yii\widgets\LinkPager::className(),
                'firstPageLabel' => Yii::t('cruds', 'First'),
                'lastPageLabel' => Yii::t('cruds', 'Last'),
            ],
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
            'headerRowOptions' => ['class' => 'x'],
            'columns' => [
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => $actionColumnTemplateString,
                    'buttons' => [
                        // 'view' => function ($url, $model, $key) {
                        //     $options = [
                        //         'title' => Yii::t('cruds', 'View'),
                        //         'aria-label' => Yii::t('cruds', 'View'),
                        //         'data-pjax' => '0',
                        //     ];
                        //     return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                        // }
                    ],
                    'urlCreator' => function($action, $model, $key, $index) {
                        // using the column name as key, not mapping to 'id' like the standard generator
                        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                        $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
                        return Url::toRoute($params);
                    },
                    'contentOptions' => ['nowrap' => 'nowrap']
                ],
				'name',
            ]
        ]); ?>
        <?php Pjax::end(); ?>

    </div>

</div>



