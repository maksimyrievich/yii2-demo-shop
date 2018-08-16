<?php

namespace shop\forms\Shop\Order;

use shop\entities\User\User;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii;
use yii\db\Query;
use shop\entities\Shop\DeliveryMethod;
use shop\helpers\PriceHelper;

class CustomerForm extends Model
{
    public $note;
//    public $method;
//    public $address;

    public $weight;

    public $imya; //Фамилия имя отчество получателя
    public $country;//страна получателя
    public $town;   //город/населённый пункт
    public $townru; //город/населённый пункт России
    public $street; //улица
    public $indexru;  //почтовый индекс для России
    public $index;  //почтовый индекс
    public $phone; //Телефон получателя

    public function __construct(int $weight, array $config = [])
    {
        $this->weight = $weight;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['imya', 'country', 'town',  'street', 'indexru', 'index', 'phone', 'townru'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'country' => 'Страна',
            'town' => 'Город или Населенный пункт, Район, Область',
            'townru' => 'Город или Населенный пункт',
            'index' => 'Почтовый индекс',
            'indexru' => 'Почтовый индекс',
            'street' => 'Улица, дом, квартира',
            'imya' => 'Фамилия Имя Отчество',
            'phone' => 'Телефон',

        ];
    }
    //Выводит список стран в которые разрешена доставка из админки
    public function countryList(): array
    {
        $methods = Yii::$app->db->createCommand('SELECT * FROM postcalc_light_countries where publish=1')
            ->queryAll();
        return ArrayHelper::map($methods, 'iso2', 'country');
    }

    public function deliveryMethodsList(): array
    {
        $methods = DeliveryMethod::find()->availableForWeight($this->_weight)->orderBy('sort')->all();

        return ArrayHelper::map($methods, 'id', function (DeliveryMethod $method) {
            return $method->name . ' (' . PriceHelper::format($method->cost) . ')';
        });
    }

}