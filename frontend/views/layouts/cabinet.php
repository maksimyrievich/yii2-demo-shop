<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="row">
    <div id="content" class="col-sm-9">
        <?= $content ?>
    </div>
    <aside id="column-right" class="col-sm-3 hidden-xs">
        <div class="list-group">
            <a href="<?= Html::encode(Url::to(['/auth/auth/login'])) ?>" class="list-group-item">Вход</a>
            <a href="<?= Html::encode(Url::to(['/auth/signup/request'])) ?>" class="list-group-item">Регистрация</a>
            <a href="<?= Html::encode(Url::to(['/auth/reset/request'])) ?>" class="list-group-item">Изменение пароля</a>
            <a href="<?= Html::encode(Url::to(['/cabinet/default/index'])) ?>" class="list-group-item">Мой кабинет</a>
            <a href="<?= Html::encode(Url::to(['/cabinet/wishlist/index'])) ?>" class="list-group-item">Список пожеланий</a>
            <a href="/account/order" class="list-group-item">Мои заказы</a>
            <a href="/account/newsletter" class="list-group-item">Новостная рассылка</a>
        </div>
    </aside>
</div>

<?php $this->endContent() ?>
