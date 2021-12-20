<?php
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Html;
/* @var $populars array */
/* @var $popular_product \app\models\PopularProduct */

?>
<section class="popular" id="popular">
    <div class="block">
        <h4>Популярні товари</h4>
        <div class="slider">

            <?php foreach ($populars as $popular_product): ?>
            <div class="item">
                <div class="img">
                    <img src="<?= Yii::getAlias('@web/loaded/' . $popular_product->image) ?>" alt="">
                </div>
                <div class="info">
                    <h5><?= $popular_product->name?></h5>
                    <p class="p2"><?= $popular_product->product_code?></p>
                    <p class="p1"><?= $popular_product->description?></p>
                </div>
                <div class="button">
                    <a href="<?= $popular_product->product_link?>">
                        <h6>Детальніше про товар</h6>
                    </a>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <div class="arrows"></div>
    </div>
</section>

