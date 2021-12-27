<?php

namespace app\custom;

use Yii;


interface IFileSaving
{
    public function saveOrUpdateFile();
    public function saveWithFiles();
    public function getFilePathByAttribute();
    public function getFilePathByUrl();
}