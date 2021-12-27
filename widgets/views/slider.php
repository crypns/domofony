<?php
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Html;

/* @var $models array */
/* @var $model \app\models\HomeSlider */
/* @var $layoutClass string */
?>

<section class="<?= $layoutClass ?>" id="banner">
    <div class="block">
        <div class="slider">

            <?php foreach ($models as $model): ?>
                <div class="item">
                    <div class="text">
                        <h1><?= $model->name?></h1>
                        <h5><?= $model->description?></h5>
                        <a href="<?= $model->product_link?>" target="_blank">
                            <h5>Детальна інформація</h5>
                        </a>
                    </div>
                    <div class="img">
                        <img src="<?= $model->getFilePathByAttribute(); ?>" alt="">
                    </div>
                </div>
            <?php endforeach;?>

        </div>
    </div>
</section>



