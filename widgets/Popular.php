<?php

namespace app\widgets;

use yii\base\Widget;

class Popular extends Widget
{

    public array $populars;

    public function run()
    {
        return $this->render('popular', [
            'populars' => $this->populars,
        ]);
    }
}