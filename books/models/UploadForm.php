<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
    {
    /**
    * @var UploadedFile
    */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {

//        echo '<pre>';
//        var_dump(
//            $this->validate(),
//            $this->getErrors()
//        );
//        echo '</pre>';
//        die;

        if ($this->validate()) {
            $this->imageFile->saveAs('books/runtime/upload/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}