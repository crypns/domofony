<?php

namespace app\custom;

use yii\base\InvalidConfigException;


trait TrDefineConstantsChecking {

    /**
     * Check of constant defined
     *
     * @param $constantName str
     * @throws yii\base\InvalidConfigException If constant not defined
     */
    public function checkConstantDefined(string $constantName)
    {
        if (!defined("static::$constantName")) {
            throw new InvalidConfigException("Constant $constantName not defined in " . static::class);
        }
    }

    /**
     * Check if property of class isset
     *
     * @param $propertyName str
     * @throws yii\base\InvalidConfigException If property not isset
     */
    public function checkPropertyIsset(string $propertyName)
    {
        if (!isset($propertyName)) {
            throw new InvalidConfigException(static::class . " has no property $propertyName");
        }
    }
}