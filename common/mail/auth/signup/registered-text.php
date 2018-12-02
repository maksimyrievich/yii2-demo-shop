<?php

/* @var $this yii\web\View */
/* @var $user \shop\entities\User\User */
use yii\helpers\Html;
?>
    Здравствуйте <?= $user->username ?>!
    Вы зарегистрированы на сайте автосезам.
    Для входа на сайт ипользуйте свои учётные данные:

    Логин: <?= Html::encode($user->username) ?>
    Пароль: <?= Html::encode($user->password) ?>


    Не удаляйте это письмо!

<?= $confirmLink ?>