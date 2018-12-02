<?php

namespace shop\helpers;

use shop\entities\Shop\Order\Status;
use shop\entities\Shop\Product\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class OrderHelper
{
    public static function statusList(): array
    {
        return [
            Status::WAITINGPAIMENT => 'ОЖИДАЕТ ОПЛАТЫ',
            Status::TAKEN => 'ВЗЯТ НА ОБРАБОТКУ',                       //Взят на обработку
            Status::PREPARING => 'ГОТОВИТСЯ К ОТПРАВКЕ',                //Готовится к отправке
            Status::PAID => 'ОПЛАЧЕН',                                     //Оплачен
            Status::SENT => 'ОТПРАВЛЕН',                                     //Отправлен
            Status::COMPLETED => 'ЗАВЕРШЕН',                           //Завершен
            Status::CANCELLED => 'ОТМЕНЕН',                           //Отменен
            Status::CANCELLED_BY_CUSTOMER => 'ОТМЕНЕН ПОКУПАТЕЛЕМ',   //Отменен пользователем
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case Product::STATUS_DRAFT:
                $class = 'label label-primary';
                break;
            case Product::STATUS_ACTIVE:
                $class = 'label label-primary';
                break;
            default:
                $class = 'label label-success';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}