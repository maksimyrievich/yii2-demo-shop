<?php

/* @var $this yii\web\View */
/* @var $cart \shop\cart\Cart */
/* @var $model \shop\forms\Shop\Order\CustomerForm */

use shop\helpers\PriceHelper;
use shop\helpers\WeightHelper;
use kartik\widgets\Select2;
use yii\web\JsExpression ;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Оформление заказа';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => 'Корзина', 'url' => ['shop/cart/index']];
$this->params['breadcrumbs'][] = $this->title;

\frontend\assets\CheckoutAsset::register($this);
?>
<style xmlns="http://www.w3.org/1999/html">
    .symb{
        font-size:18px;
        display: inline-block;
        width:20px;
        text-align: center;
    }
    .yes:before{
        content: '\2714';
        color:green;
    }
    .no:before{
        content: '\2709';
        color:red;
    }
</style>
<div class="cabinet-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="panel panel-success" id="one">
        <div class="panel-heading accordion-one">Таблица товаров<div class="symb"></div>
    </div>
        <div class="panel-body panel-one">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td class="text-left">Товар</td>
                        <td class="text-left">Модель</td>
                        <td class="text-left">Количество</td>
                        <td class="text-right">Unit Price</td>
                        <td class="text-right">Всего</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cart->getItems() as $item): ?>
                        <?php
                        $product = $item->getProduct();
                        $modification = $item->getModification();
                        $url = Url::to(['/shop/catalog/product', 'id' => $product->id]);
                        ?>
                        <tr>
                            <td class="text-left">
                                <a href="<?= $url ?>"><?= Html::encode($product->name) ?></a>
                            </td>
                            <td class="text-left">
                                <?php if ($modification): ?>
                                    <?= Html::encode($modification->name) ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-left">
                                <?= $item->getQuantity() ?> шт.
                            </td>
                            <td class="text-right"><?= PriceHelper::format($item->getPrice()) ?> руб.</td>
                            <td class="text-right"><?= PriceHelper::format($item->getCost()) ?> руб.</td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <br />

            <div class="row">
                <div class="col-lg-8"></div>
                <div class="col-lg-4 col-sm-offset-8">
                    <?php $cost = $cart->getCost() ?>
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-right"><strong>Sub-Total:</strong></td>
                            <td class="text-right"><?= PriceHelper::format($cost->getOrigin()) ?> руб.</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Всего:</strong></td>
                            <td class="text-right"><?= PriceHelper::format($cost->getTotal()) ?> руб.</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Вес:</strong></td>
                            <td class="text-right"><?= WeightHelper::format($cart->getWeight()) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <?php $form = ActiveForm::begin(['id' => 'customer-form','enableClientValidation' => false]) ?>
        <div class="panel panel-default" id="two">
            <div class="panel-heading accordion-two">Адрес получателя<div class="symb"></div>
        </div>
            <div class="panel-body panel-two">
                <div class="row">
                    <div class="col-lg-5">
                        <?= $form->field($model, 'country')->dropDownList($model->countryList()) ?>
                        <?= $form->field($model, 'town')->textInput()?>
                        <?= $form->field($model, 'townru')->widget(Select2::classname(), [
                            'initValueText' => [$tmp->pindex => $tmp->city], // set the initial display text
                            'options' => [],
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'pluginOptions' => [
                                'allowClear' => false,
                                'minimumInputLength' => 3,
                                'language' => [
                                    'errorLoading' => new JsExpression("function () { return 'Нет результата ...'; }"),
                                    'inputTooShort' => new JsExpression("function () { return 'Введите цифры индекса...'; }"),
                                    'searching' => new JsExpression("function () { return 'Поиск ...'; }"),
                                ],
                                'ajax' => [
                                    'url' => Url::to(['/shop/checkout/citylist']),
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                            ],
                        ]);?>
                        <?= $form->field($model, 'street')->textInput() ?>
                        <?= $form->field($model, 'index')->textInput() ?>
                        <?= $form->field($model, 'indexru')->widget(Select2::classname(), [
                            //'initValueText' => $model->adress->countryInit(), // set the initial display text
                            'options' => ['placeholder' => ''],
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'pluginOptions' => [
                                'allowClear' => false,
                                'minimumInputLength' => 3,
                                'language' => [
                                    'errorLoading' => new JsExpression("function () { return 'Нет результата ...'; }"),
                                    'inputTooShort' => new JsExpression("function () { return 'Введите цифры индекса...'; }"),
                                    'searching' => new JsExpression("function () { return 'Поиск ...'; }"),
                                ],
                                'ajax' => [
                                    'url' => Url::to(['/shop/checkout/indexlist']),
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                            ],
                        ]);?>
                        <?= $form->field($model, 'imya')->textInput() ?>
                        <?= $form->field($model, 'phone',['addon' => ['prepend' => ['content'=>'+']]]) ?>
                        <div class="panel-body" style=" text-align:left">
                            <?= Html::Button('Продолжить',['class'=> 'btn btn-success btn-one','id'=>'customerform-submit'])?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    <div class="panel panel-default" id="three">
        <div class="panel-heading accordion-three">Cпособ доставки <span class="symb"></span></div>
        <div id='conte' class="panel-body panel-three ">

            <div>
                <table class="table">
                    <thead>
                    <tr>
                        <td class="text-left"></td>
                        <td class="text-left">Описание вариантов</td>
                        <td class="text-left">Стоимость</td>
                        <td class="text-left">Срок</td>
                    </tr>
                    </thead>
                    <tbody>
                        <?= $form->field($model, 'delivery_method', ['template' => '{input}'])->radiolist([
                                '0' => 'Почта России (наземная посылка)',
                                '1' => 'Почта России (наземная посылка со страховкой)',
                                '2' => 'Почта России (наложенным платежом)',
                            ],
                        ['item' => function($label, $name, $options){
                            switch ($label){
                                case 0:
                                    $value = 1;
                                    $url = Url::to('@static/delivery_img/russian_post.gif');
                                    $id = 'nazemnaya_posilka_price';
                                    $ids = 'nazemnaya_posilka_time';
                                    break;
                                case 1:
                                    $value = 2;
                                    $url = Url::to('@static/delivery_img/russian_post.gif');
                                    $id = 'nazemnaya_posilka_strah_price';
                                    $ids = 'nazemnaya_posilka_strah_time';
                                    break;
                                case 2:
                                    $value = 3;
                                    $url = Url::to('@static/delivery_img/russian_post.gif');
                                    $id = 'naloj_platej_price';
                                    $ids = 'naloj_platej_time';
                                    break;
                            }
                            return
                            Html::beginTag('tr').
                            Html::beginTag('td').
                            Html::beginTag('input',['type'=> 'radio','name' => 'CustomerForm[delivery_method]', 'value'=> $value]).
                            Html::endTag('td').

                            Html::beginTag('td').
                            Html::beginTag('span').
                            Html::beginTag('img',['src'=>Html::encode($url)]).
                            Html::endTag('span')." ".
                            Html::beginTag('span'). $name .
                            Html::endTag('span').
                            Html::endTag('td').

                            Html::beginTag('td').
                            Html::beginTag('span',['id'=> $id]).
                            Html::endTag('span').
                            Html::beginTag('span')." руб.".
                            Html::endTag('span').
                            Html::endTag('td').

                            Html::beginTag('td').
                            Html::beginTag('span',['id'=> $ids]).
                            Html::endTag('span').
                            Html::beginTag('span')." дней.".
                            Html::endTag('span').
                            Html::endTag('td').
                            Html::endTag('tr')
                            ;}]) ?>
                    </tbody>
                </table>
            </div>
            <div class="panel-body" style="text-align:left">
                <?= Html::Button('Продолжить',['class'=> 'btn btn-success btn-two','id'=>'customerform-submit'])?>
            </div>
        </div>
    </div>

    <div class="panel panel-default" id="four" >
        <div class="panel-heading accordion-four">Способ оплаты <span class="symb"></span></div>
        <div class="panel-body panel-four">
            <div>
                <table class="table">
                    <thead>
                    <tr>
                        <td class="text-left"></td>
                        <td class="text-left">Способы оплаты</td>
                        <td class="text-left">Описание способа</td>
                    </tr>
                    </thead>
                    <tbody>
                        <?= $form->field($model, 'payment_method', ['template' => '{input}'])->radiolist([
                            '0' => ' По квитанции через банк',
                            '1' => ' Через "Cбербанк Онлайн',
                            '2' => ' Оплатить с сайта',
                        ],
                            ['item' => function($label, $name, $options){
                                switch ($label){
                                    case 0:
                                        $value = 1;
                                        $url = Url::to('@static/payment_img/receipt.png');
                                        $id = 'nazemnaya_posilka_price';
                                        $ids = 'На e-mail будет выслан счёт и квитанция для оплаты в банке. Распечатайте ее. Возьмите паспорт и квитанцию в банк.';
                                        break;
                                    case 1:
                                        $value = 2;
                                        $url = Url::to('@static/payment_img/sberbank-onlayn.png');
                                        $id = 'nazemnaya_posilka_strah_price';
                                        $ids = 'На e-mail будет выслан счёт и номер карты для осуществления перевода.';
                                        break;
                                    case 2:
                                        $value = 3;
                                        $url = Url::to('@static/payment_img/card.gif');
                                        $id = 'naloj_platej_price';
                                        $ids = 'Онлайн оплата заказа с платежной карты Visa, Mastercard, МИР.';
                                        break;
                                }
                                return
                                    Html::beginTag('tr').
                                    Html::beginTag('td').
                                    Html::beginTag('input',['type'=> 'radio','name' => 'CustomerForm[payment_method]', 'value'=> $value]).
                                    Html::endTag('td').

                                    Html::beginTag('td').
                                    Html::beginTag('span').
                                    Html::beginTag('img',['src'=>Html::encode($url)]).
                                    Html::endTag('span')." ".
                                    Html::beginTag('span'). $name .
                                    Html::endTag('span').
                                    Html::endTag('td').

                                    Html::beginTag('td').
                                    Html::beginTag('span',['id'=> $id]).
                                    Html::endTag('span').
                                    Html::beginTag('span').$ids.
                                    Html::endTag('span').
                                    Html::endTag('td')
                                    ;}]) ?>

                    <!--<tr title="Для отправки этим способом понадобятся ваши паспортные данные">
                            <td>
                                <span id="edost_input" >
                                    <input id="shipping_id" type="radio" name="shipping_id" value="e48">
                                </span>
                            </td>
                            <td>
                                <span id="edost_logo"><img src="<?= Html::encode(Url::to('@static/delivery_img/jel_dor_ekspediciya.gif')) ?>"></span>
                                <span id="edost_title"> ЖелДорЭкспедиция (до подъезда)</span>
                            </td>
                            <td>
                                <span id="edost_price">460.00 руб.</span>
                            </td>
                            <td>
                                <span id="edost_delivery">2-4 дня</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span id="edost_input">
                                    <input id="shipping_id" type="radio" name="shipping_id" value="e49">
                                </span>
                            </td>
                            <td>
                                <span id="edost_logo"><img src="<?= Html::encode(Url::to('@static/delivery_img/pek.gif')) ?>"></span>
                                <span id="edost_title"> ПЭК (до подъезда)</span>
                            </td>
                            <td>
                                <span id="edost_price">1 376.00 руб.</span>
                            </td>
                            <td>
                                <span id="edost_delivery">5-12 дней</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span id="edost_input">
                                    <input id="shipping_id" type="radio" name="shipping_id" value="e51">
                                </span>
                            </td>
                            <td>
                                <span id="edost_logo"><img src="<?= Html::encode(Url::to('@static/delivery_img/delovie_linii.gif')) ?>"></span>
                                <span id="edost_title"> Деловые линии (до подъезда)</span>
                            </td>
                            <td>
                                <span id="edost_price">1 545.00 руб.</span>
                            </td>
                            <td>
                                <span id="edost_delivery">5-12 дней</span>
                            </td>
                        </tr> -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default" id="five" >
        <div class="panel-heading accordion-five">Способ оплаты <span class="symb"></span></div>
        <div class="panel-body panel-five">
            <?= $form->field($model, 'note')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Checkout', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end() ?>





</div>
    
