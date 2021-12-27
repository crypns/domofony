<?php

namespace app\models;

use Yii;
use \app\models\base\PopularProduct as BasePopularProduct;
use app\custom\IFileSaving;
use app\helpers\ContentHelper;

/**
 * This is the model class for table "popular_products".
 */
class PopularProduct extends BasePopularProduct implements IFileSaving
{
    const FILE_URL = '@web/loaded/popular_product/';
    const FILE_PATH = '@webroot/loaded/popular_product/';
    const DEFAULT_IMAGE = 'default.svg';

    const FILE_NAME_ATTRIBUTE = 'image';
    const UPLOAD_FILE_ATTRIBUTE = 'imageFile';

    public $imageFile;

    // Use this method to set primary name column if it has not standart name
    public function getLabel()
    {
        // return $this->full_name;
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            # custom behaviors
        ]);
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            ['imageFile', 'file', 'skipOnEmpty' => true, 'extensions' => 'gif, jpg, jpeg, png'],
            ['image', 'default', 'value' => self::DEFAULT_IMAGE],
        ]);
    }
    public function getInititalPhotoPreviewConfig()
    {
        return [ContentHelper::getKartikFilePreviewConfig($this, '/admin/file/delete-without-model')];
    }
}
