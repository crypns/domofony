<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;

use app\widgets\Alert;
use app\widgets\Footer;
use app\widgets\Header;
use app\widgets\Head;

use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">

    <?= Head::widget(); ?>

    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <?= Header::widget(); ?>

    <main role="main" class="flex-shrink-0">
        <div>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <?= Footer::widget(); ?>

    <?php $this->endBody() ?>
    </body>
    <script>
        (function(w,d,u){
            var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
            var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://cdn.bitrix24.ua/b4096045/crm/site_button/loader_8_1kmc0y.js');
    </script>
    </html>
<?php $this->endPage();
