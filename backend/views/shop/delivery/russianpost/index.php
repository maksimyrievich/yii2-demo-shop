<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 19.08.2018
 * Time: 4:58
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \backend\forms\Shop\delivery\RusPostSetForm */

$this->title = 'Почта России: настройки';
$this->params['breadcrumbs'][] = ['label' => 'Способы доставки','url' => ['shop/delivery/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-body">
            <?php $form = ActiveForm::begin(['id' => 'ruspostset-form']) ?>
                <div class="box-body">
                    <p>
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                        <?= Html::a('Закрыть', ['/shop/delivery/list'], ['class' => 'btn btn-primary']) ?>
                    </p>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" style="font-weight: bold">Общие</a></li>
                            <li><a href="#tab_2" data-toggle="tab" style="font-weight: bold">Наценка</a></li>
                            <li><a href="#tab_3" data-toggle="tab" style="font-weight: bold">Упаковка</a></li>
                            <li><a href="#tab_4" data-toggle="tab" style="font-weight: bold">Статистика</a></li>
                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div>
                                <div class = row>
                                    <div class = col-lg-4>
                                        <?= $form->field($model, 'public')->dropDownList(
                                                [1 => 'Да', 0 => 'Нет'], ['class' => 'form-control input-sm']) ?>
                                        <?= $form->field($model, 'nalplatej')->dropDownList(
                                            [1 => 'Да', 0 => 'Нет'], ['class' => 'form-control input-sm']) ?>
                                        <?= $form->field($model, 'tiprasch')->dropDownList(
                                            [0 => 'Без страховки', 1 => 'Со страховкой', 2 => 'Без страховки и со страховкой'],
                                            ['class' => 'form-control input-sm']) ?>
                                        <?= $form->field($model, 'maxves')->textInput(['class' => 'form-control input-sm'])?>

                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div>
                                <div class="form-group">
                                    <p>
                                        Данная настройка позволяет задать прибавку к расчету стоимости доставки в зависимости от
                                        веса заказа. В первой графе задается минимальный и максимальный диапазон веса заказа
                                        а во второй колонке - стоимость надбавки для этого диапазона веса заказа. Сумма из
                                        второй колонки прибавляется к расчётной стоимости сделаной по API.
                                    </p>
                                </div>
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div>
                                <div class="checkbox">

                                        <?= $form->field($model, 'nacenDiffEnable')->checkbox()?>

                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <td class="text-center" style="font-weight: bold">Вес товара мин - макс (грамм)</td>
                                            <td class="text-center" style="font-weight: bold">Сумма (руб.)</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td >
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'nacenMin1')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'nacenMax1')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="form-group">
                                                    <?= $form->field($model, 'nacenSumm1')->textInput(['class' => 'form-control input-sm'])?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'nacenMin2')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'nacenMax2')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="form-group">
                                                    <?= $form->field($model, 'nacenSumm2')->textInput(['class' => 'form-control input-sm'])?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'nacenMin3')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'nacenMax3')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="form-group">
                                                    <?= $form->field($model, 'nacenSumm3')->textInput(['class' => 'form-control input-sm'])?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'nacenMin4')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'nacenMax4')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="form-group">
                                                    <?= $form->field($model, 'nacenSumm4')->textInput(['class' => 'form-control input-sm'])?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'nacenMin5')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'nacenMax5')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="form-group">
                                                    <?= $form->field($model, 'nacenSumm5')->textInput(['class' => 'form-control input-sm'])?>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div>
                                <p>
                                    Данная настройка позволяет задать прибавку к общему весу посылки в зависимости от
                                    веса товара. В первой графе задается минимальный и максимальный диапазон веса товара
                                    а во второй колонке - величина  надбавки веса для этого диапазона веса товара из
                                    заказа. Величина веса тары из второй колонки прибавляется к весу товара и передается
                                    для расчета стоимости доставки по API.
                                </p>
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div>
                                <div class="checkbox">
                                    <?= $form->field($model, 'upakovDiffEnable')->checkbox()?>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <td class="text-center" style="font-weight: bold">Вес товара мин - макс (грамм)</td>
                                            <td class="text-center" style="font-weight: bold">Вес упаковки (грамм)</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td >
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'upakovMin1')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'upakovMax1')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="form-group">
                                                    <?= $form->field($model, 'upakovSumm1')->textInput(['class' => 'form-control input-sm'])?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'upakovMin2')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'upakovMax2')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="form-group">
                                                    <?= $form->field($model, 'upakovSumm2')->textInput(['class' => 'form-control input-sm'])?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'upakovMin3')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'upakovMax3')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="form-group">
                                                    <?= $form->field($model, 'upakovSumm3')->textInput(['class' => 'form-control input-sm'])?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'upakovMin4')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'upakovMax4')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="form-group">
                                                    <?= $form->field($model, 'upakovSumm4')->textInput(['class' => 'form-control input-sm'])?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'upakovMin5')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                                        <?= $form->field($model, 'upakovMax5')->textInput(['class' => 'form-control input-sm'])?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="form-group">
                                                    <?= $form->field($model, 'upakovSumm5')->textInput(['class' => 'form-control input-sm'])?>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_4">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div>
                                <a href="<?=Yii::getAlias('@static/russianpost/postcalc_light_stat.php')?>" target="_blank" style="font-weight: bold">Статистика расчётов на сайте</a>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>





                </div>
            <?php ActiveForm::end() ?>
            <!-- /.box -->
        </div>
    </div>
<!-- /.col -->
</div>
<!-- ./row -->