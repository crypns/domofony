<?php
 
namespace tests\unit\fixtures;
 
use yii\test\ActiveFixture;
 
class ProductFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Product';
    public $dataFile = '@tests/unit/fixtures/data/product.php';

    public $depends = [
        'tests\unit\fixtures\CategoryFixture',
    ];
}