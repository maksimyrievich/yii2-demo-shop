<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 05.07.2018
 * Time: 21:40
 */
namespace shop\forms\Shop\Order;

use yii\base\Model;

class AdressForm extends Model
{

    public $country;//страна
    public $region; //область
    public $town;   //город
    public $raion;  //район/населённый пункт
    public $index;  //почтовый индекс
    public $street; //улица

    public function rules(): array
    {
        return [
            [['country', 'region','town','index','street'], 'required'],
            [['country', 'region','town','raion','index','street'], 'string', 'max' => 255],
        ];
    }
}