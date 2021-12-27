<?php

namespace app\models;

use Yii;
use \app\models\base\HomeSlider as BaseHomeSlider;
use app\custom\IFileSaving;
use app\helpers\ContentHelper;

/**
 * This is the model class for table "home_sliders".
 */
class HomeSlider extends BaseHomeSlider implements IFileSaving
{
    const FILE_URL = '@web/loaded/home_slider/';
    const FILE_PATH = '@webroot/loaded/home_slider/';
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
