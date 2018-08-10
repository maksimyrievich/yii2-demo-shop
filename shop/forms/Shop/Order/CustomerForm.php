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
    public $method;
    public $address;

    private $_weight;

    public $choice; //выбор кому отправлять
    public $email; //емайл покупателя
    public $phone; //телефон покупателя
    public $imya; //Фамилия имя отчество получателя
    public $country;//страна получателя
    public $town;   //город/населённый пункт
    public $street; //улица
    public $indexru;  //почтовый индекс для России
    public $index;  //почтовый индекс
    public $recipientphone; //Телефон получателя

    public function __construct(int $weight, array $config = [])
    {
        $this->_weight = $weight;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['choice'], 'boolean'],
            [['email'], 'unique', 'targetClass' => User::class, 'message' => 'Покупатель с таким емайлом уже зарегистрирован'],
            [['phone'], 'unique', 'targetClass' => User::class, 'message' => 'Покупатель с таким телефоном уже зарегистрирован'],
            [['imya', 'country', 'town',  'street', 'indexru', 'index', 'recipientphone','note','method','address'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'choice' => 'Отправить этот заказ другу?',
            'country' => 'Страна',
            'town' => 'Город или Населенный пункт, Район, Область',
            'index' => 'Почтовый индекс',
            'indexru' => 'Почтовый индекс',
            'street' => 'Улица, дом, квартира',
            'imya' => 'Фамилия Имя Отчество',
            'phone' => 'Ваш телефон',
            'email' => 'Ваш емайл',
            'recipientphone' => 'Телефон получателя',

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