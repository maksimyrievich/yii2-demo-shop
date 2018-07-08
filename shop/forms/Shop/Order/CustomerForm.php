<?php

namespace shop\forms\Shop\Order;

use yii\base\Model;

class CustomerForm extends Model
{

    public $familia;
    public $imya;
    public $otchestvo;
    public $phone;
    public $email;

    public function rules(): array
    {
        return [
            [['phone', 'familia','imya','otchestvo','email'], 'required'],
            [['phone', 'familia','imya','otchestvo','email'], 'string', 'max' => 255],
        ];
    }
}