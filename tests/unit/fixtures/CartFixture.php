<?php
 
namespace tests\unit\fixtures;
 
use yii\test\ActiveFixture;
 
class CartFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Cart';
    public $dataFile = '@tests/unit/fixtures/data/cart.php';

    public $depends = [
    ];
}