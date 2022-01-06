<?php
 
namespace tests\unit\fixtures;
 
use yii\test\ActiveFixture;
 
class SettingFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Setting';
    public $dataFile = '@tests/unit/fixtures/data/setting.php';

    public $depends = [
    ];
}