<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\auth\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Вход на сайт';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-sm-6">
        <div class="well">
            <h2>Регистрация</h2>
            <p><strong>Регистрация нового пользователя</strong></p>
            <p>Создав учетную запись, вы сможете сделать у нас покупки , быть в курсе состояния ваших заказов а так же отслеживать заказы, которые вы сделали ранее.</p>
            <a href="<?= Html::encode(Url::to(['/auth/signup/request'])) ?>" class="btn btn-primary">Продолжить</a>
        </div>
        <div class="well">
            <h2>Войти</h2>
            <p><strong>через социальную сеть</strong></p>
            <?= yii\authclient\widgets\AuthChoice::widget([
                'baseAuthUrl' => ['auth/network/auth']
            ]); ?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="well">
            <h2>Вход на сайт</h2>
            <p><strong>Для зарегистрированного пользователя</strong></p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput() ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                Если вы забыли свой пароль вы можете его<?= Html::a(' поменять', ['auth/reset/request']) ?>
            </div>

            <div>
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
