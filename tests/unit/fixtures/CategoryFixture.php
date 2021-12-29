<?php
 
namespace tests\unit\fixtures;
 
use yii\test\ActiveFixture;
 
class CategoryFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Category';
    public $dataFile = '@tests/unit/fixtures/data/category.php';

    public $depends = [
    ];
}