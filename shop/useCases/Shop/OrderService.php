<?php

namespace shop\useCases\Shop;

use shop\cart\Cart;
use shop\cart\CartItem;
use shop\entities\Shop\options\Country;
use shop\entities\Shop\options\Cities;
use shop\entities\Shop\Order\CustomerData;
use shop\entities\Shop\Order\DeliveryData;
use shop\entities\Shop\Order\Order;
use shop\entities\Shop\Order\OrderItem;
use shop\entities\Shop\Order\Status;
use shop\forms\Shop\Order\CustomerForm;
use shop\forms\Shop\Order\OrderForm;
use shop\repositories\Shop\DeliveryMethodRepository;
use shop\repositories\Shop\OrderRepository;
use shop\repositories\Shop\ProductRepository;
use shop\repositories\UserRepository;
use shop\services\TransactionManager;

class OrderService
{
    private $cart;
    private $orders;
    private $products;
    private $users;
    private $deliveryMethods;
    private $paymentMethods;
    private $transaction;

    public function __construct(
        Cart $cart,
        OrderRepository $orders,
        ProductRepository $products,
        UserRepository $users,
        DeliveryMethodRepository $deliveryMethods,
        TransactionManager $transaction
    )
    {
        $this->cart = $cart;
        $this->orders = $orders;
        $this->products = $products;
        $this->users = $users;
        $this->deliveryMethods = $deliveryMethods;
        $this->transaction = $transaction;

    }

    public function checkout($userId, CustomerForm $form): Order
    {
        $user = $this->users->get($userId);

        $products = [];

        $items = array_map(function (CartItem $item) use (&$products) {
            $product = $item->getProduct();
            $product->checkout($item->getModificationId(), $item->getQuantity());
            $products[] = $product;
            return OrderItem::create(
                $product,
                $item->getModificationId(),
                $item->getPrice(),
                $item->getQuantity()
            );
        }, $this->cart->getItems());

        if($form->delivery_method == 3){                //Если в качестве способа доставки наложенный платеж,
            $status = Status::PREPARING;        //тогда выставляем заказу статус готовится к отправке
        }else{                                  //иначе
            $status = Status::WAITINGPAIMENT;}  //выставляем заказу статус ожидает оплаты

        $order = Order::create(
            $user->id,
            new CustomerData(
                $form->phone,
                $form->imya
            ),
            $items,
            $this->cart->getCost()->getTotal(),
            $form->note,
            $status,
            $this->cart->getWeight()
        );
        //*****************************  Здесь начинается блок кода извлечения адреса доставки  ************************
        if($form->country === 'RU'){    //Если в качестве страны выбрана Россия,
            $index = $form->indexru;    //тогда индекс берем из ячейки $form->indexru
            $town = Cities::findOne(['pindex' =>$form->townru]); //Достаем строку из БД
            $town = $town->city;  //Из строки берем название города
        }else{
            $index = $form->index;  //Если страна любая другая, тогда индекс места доставки заказа берем из ячейки $form->index
            $town = $form->town;}     //Если страна любая другая, тогда город места доставки заказа берем из ячейки $form->town

        $country = Country::findOne(['iso2' =>$form->country]); //Преобразуем значение страны в удобочитаемый вид

        $order->setDeliveryInfo(
            $this->deliveryMethods->get($form->delivery_method), //Приведем метод доставки  в удобочитаемый вид,
            new DeliveryData(
                $index ,            //Подставляем значение индекса места доставки из переменной
                $country->country,  //Добавляем значение страны
                $town,              //Добавляем значение города
                $form->street       //Добавляем значение улицы
            )
        );

        if($form->delivery_method == 3){
            $this->paymentMethods = "Оплата при получении на почте";
        }else{
            switch ($form->payment_method){
                case 1: $this->paymentMethods = "По квитанции через банк"; break;
                case 2: $this->paymentMethods = "Через \"Cбербанк Онлайн\""; break;
                case 3: $this->paymentMethods = "Онлайн оплата с сайта"; break;
            }
        }

        $order->setPaymentInfo($this->paymentMethods);

        $this->transaction->wrap(function () use ($order, $products) {
            $this->orders->save($order);
            foreach ($products as $product) {
                $this->products->save($product);
            }
            $this->cart->clear();
        });

        return $order;
    }
}