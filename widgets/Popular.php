<?php

namespace app\widgets;

use yii\base\Widget;

class Popular extends Widget
{

    public function run()
    {
        return $this->render('popular', [
        ]);
    }
}