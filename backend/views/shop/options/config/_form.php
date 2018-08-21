<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 19.08.2018
 * Time: 4:56
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model shop\entities\Shop\options\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?= Html::a('Назад', ['shop/options/config/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) //textInput(['maxlength' => true, 'readonly' => true])?>

    <?= $form->field($model, 'param')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'default')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>



    <?php ActiveForm::end(); ?>

</div>