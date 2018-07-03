<?php

namespace shop\forms\manage\Shop\Product;

use yii\base\Model;
use yii\web\UploadedFile;

class PhotosForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $files;

    public function rules(): array
    {
        return [
            //Здесь мы используем валидатор 'each' позволяющий валидировать массив картинок
            ['files', 'each', 'rule' => ['image']],
        ];
    }


    /**
     * @return bool
     *
     * Подгружаем файл картинки перед валидацией формы
     */
    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            //Чтение файла из глобального массива FILES
            $this->files = UploadedFile::getInstances($this, 'files'); //S_FILES
            return true;
        }
        return false;
    }
}