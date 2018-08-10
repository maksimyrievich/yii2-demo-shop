<?php

/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 09.07.2018
 * Time: 1:12
 */

namespace shop\entities\Shop\options;

use yii\db\ActiveRecord;

/**
 * @property string $city
 * @property string $pindex
 */
class Cities extends ActiveRecord
{
    public static function tableName()
    {
        return '{{postcalc_light_cities}}';
    }

    public function rules()
    {
        return [
            [['city', 'pindex'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'сity' => 'Населённый пункт',
            'pindex' => 'Почтовый индекс',
        ];
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getPindex()
    {
        return $this->pindex;
    }
}