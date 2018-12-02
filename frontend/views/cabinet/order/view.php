<?php

use shop\helpers\OrderHelper;
use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $order shop\entities\Shop\Order\Order */

$this->title = 'Заказ № ' . $order->id;
$this->params['breadcrumbs'][] = ['label' => 'Мой кабинет', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Мои заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $order,
        'attributes' => [
            [
                'attribute' => 'current_status',
                'value' => function ($order) {
                    foreach ($order->statuses as $status){
                        $data = $status->value;}
                    return OrderHelper::statusLabel($data);
                },
                'format' => 'raw',
            ],
            'created_at:datetime',
            'delivery_method_name',
            'payment_method',
            ['attribute' => 'order_weight',
                'value' => function($order){
                    return $order->order_weight/1000 . " кг.";
                },
                'format' => 'raw',
            ],
        ],
    ]) ?>

    <h4 class="text-left">Адрес доставки</h4>
    <?= DetailView::widget([
        'model' => $order,
        'attributes' => [

            'delivery_street',
            'delivery_town',
            'delivery_index',
            'delivery_country',
            'customer_name',
            'customer_phone',


            'note:ntext',
        ],
    ]) ?>

    <h4 class="text-left">Перечень товаров </h4>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="text-left">Наименование товара</th>
                <th class="text-right">Цена за единицу</th>
                <th class="text-left">Кол-во</th>
                <th class="text-right">Сумма</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($order->items as $item): ?>
                <tr>
                    <td class="text-left">
                        <?= Html::encode($item->product_name) ?>
                        <?= Html::encode($item->modification_code) ?>
                        <?= Html::encode($item->modification_name) ?>
                    </td>
                    <td class="text-right"><?= PriceHelper::format($item->price) ?> руб.</td>
                    <td class="text-left">
                        <?= $item->quantity ?>
                    </td>
                    <td class="text-right"><?= PriceHelper::format($item->getCost()) ?> руб.</td>
                </tr>
            <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="table-margin">Итого:</td>
                    <td class="table-margin"><?= $order->cost?> руб.</td>
                </tr>

            </tbody>


        </table>

    </div>

    <div class="row">
        <div class = "col-lg-8 col-md-6 col-sm-5"></div>
        <div class = "col-lg-4 col-md-6 col-sm-7">
            <div class="table">
                <table class=" table table-bordered">
                    <tbody>
                    <tr>
                        <td class="table-margin">Стоимость доставки:</td>
                        <td class="table-margin"><?= $order->delivery_cost?> руб.</td>
                    </tr>
                    <tr>
                        <td class="table-margin">Всего к оплате:</td>
                        <td class="table-margin">  <?= $order->delivery_cost + $order->cost ?> руб.</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <h4 class="text-left">История заказа</h4>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="text-left">Дата</th>
                <th class="text-left">Статус</th>
                <th class="text-left">Примечание</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($order->statuses as $status): ?>
                <tr>
                    <td class="text-left">
                        <?= Yii::$app->formatter->asDatetime($status->created_at,'dd.MM.yyyy, HH:mm:ss' ) ?>
                    </td>
                    <td class="text-left">
                        <?= OrderHelper::statusLabel($status->value) ?>
                    </td>
                    <td class="text-left">

                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if ($order->canBePaid()): ?>
        <p>
            <?= Html::a('Pay via Robokassa', ['/payment/robokassa/invoice', 'id' => $order->id], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

</div>