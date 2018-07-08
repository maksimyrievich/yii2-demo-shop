<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 07.07.2018
 * Time: 3:15
 */

namespace shop\entities\Shop\options;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Country extends ActiveRecord
{
    public static function tableName()
    {
        return '{{postcalc_light_countries}}';
    }

    public function rules()
    {
        return [
            [['country', 'iso2'], 'string'],
            [['publish'],'integer']

        ];
    }

    public function attributeLabels()
    {
        return [
            'country' => 'Страна',
            'iso2' => 'Код',
            'publish' => 'Статус',

        ];
    }

    public function getIso2()
    {
        return $this->iso2;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getPublish()
    {
        return $this->publish;
    }

    public function setPublish($data)
    {
        $this->publish = $data;
    }
}