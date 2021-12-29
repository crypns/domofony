<?php
 
namespace tests\unit\fixtures;
 
use yii\test\ActiveFixture;
 
class PopularProductFixture extends ActiveFixture
{
    public $modelClass = 'app\models\PopularProduct';
    public $dataFile = '@tests/unit/fixtures/data/popular-product.php';

    public $depends = [
    ];
}