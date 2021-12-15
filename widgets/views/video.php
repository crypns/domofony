<?php
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Html;
?>


<section class="video" id="video">
    <div class="block">
        <h4>Відеоогляди</h4>
        <div class="slider">
            <div class="item">
                <a href="https://www.youtube.com/user/domofonycomua" target="_blank">
                    <img src="<?= Yii::getAlias('@web/img/slide1.jpg') ?>" alt="">
                </a>
            </div>
            <div class="item">
                <a href="https://www.youtube.com/user/domofonycomua" target="_blank">
                    <img src="<?= Yii::getAlias('@web/img/slide2.jpg') ?>" alt="">
                </a>
            </div>
            <div class="item">
                <a href="https://www.youtube.com/user/domofonycomua" target="_blank">
                    <img src="<?= Yii::getAlias('@web/img/slide3.jpg') ?>" alt="">
                </a>
            </div>
            <div class="item">
                <a href="https://www.youtube.com/user/domofonycomua" target="_blank">
                    <img src="<?= Yii::getAlias('@web/img/slide1.jpg') ?>" alt="">
                </a>
            </div>
        </div>
        <div class="arrows"></div>
        <a target="_blank" href="https://www.youtube.com/user/domofonycomua" class="our_channel">
            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.5821 2.18612C19.3521 1.32563 18.6744 0.647926 17.8139 0.417918C16.2542 0 10 0 10 0C10 0 3.74583 0 2.18613 0.417918C1.32563 0.647926 0.647934 1.32563 0.417925 2.18612C0 3.74582 0 7 0 7C0 7 0 10.2542 0.417925 11.8139C0.647934 12.6744 1.32563 13.3521 2.18613 13.5821C3.74583 14 10 14 10 14C10 14 16.2542 14 17.8139 13.5821C18.6744 13.3521 19.3521 12.6744 19.5821 11.8139C20 10.2542 20 7 20 7C20 7 20 3.74582 19.5821 2.18612Z" fill="#FF0000"/>
                <path d="M7.95459 9.9545L13.1819 7.00004L7.95459 4.04541V9.9545Z" fill="white"/>
            </svg>
            <h6>Наш канал “Домофонні системи”</h6>
        </a>
    </div>
</section>
