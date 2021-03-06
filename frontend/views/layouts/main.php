<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\widgets\Shop\CartWidget;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
$this->registerLinkTag(['rel' => 'shortcut icon',  'sizes' => '64x64','type' => 'image/png', 'href' => Url::to(['/favicon_64x64px.png'])]);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '152x152', 'type' => 'image/png', 'href' => Url::to(['/favicon_152x152px.png'])]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" lang="en">
<!--<![endif]-->
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="<?= Html::encode(Url::canonical()) ?>" rel="canonical"/>
    <?php $this->head() ?>
</head>
<body class="common-home">
<?php $this->beginBody() ?>
<nav id="top">
    <div class="container">
        <div class="pull-left">
            <form action="/index.php?route=common/currency/currency" method="post"
                  enctype="multipart/form-data" id="form-currency">
                <div class="btn-group">
                    <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                        <strong>$</strong>
                        <span class="hidden-xs hidden-sm hidden-md">Валюта</span> <i class="fa fa-caret-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <button class="currency-select btn btn-link btn-block" type="button" name="EUR">€ Euro
                            </button>
                        </li>
                        <li>
                            <button class="currency-select btn btn-link btn-block" type="button" name="GBP">£ Pound
                                Sterling
                            </button>
                        </li>
                        <li>
                            <button class="currency-select btn btn-link btn-block" type="button" name="USD">$ US
                                Dollar
                            </button>
                        </li>
                    </ul>
                </div>
                <input type="hidden" name="code" value=""/>
                <input type="hidden" name="redirect" value="/index.php?route=common/home"/>
            </form>
        </div>
        <div id="top-links" class="nav pull-right">
            <ul class="list-inline">
                <li><a href="/index.php?route=information/contact"><i class="fa fa-phone"></i></a>
                    <span class="hidden-xs hidden-sm hidden-md">+79271303507</span></li>
                <li class="dropdown"><a href="" title="Мой кабинет"
                                        class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span
                                class="hidden-xs hidden-sm hidden-md">Мой кабинет</span> <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <?php if (Yii::$app->user->isGuest): ?>
                            <li><a href="<?= Html::encode(Url::to(['/auth/auth/login'])) ?>">Вход</a></li>
                            <li><a href="<?= Html::encode(Url::to(['/auth/signup/request'])) ?>">Регистрация</a></li>
                        <?php else: ?>
                            <li><a href="<?= Html::encode(Url::to(['/cabinet/default/index'])) ?>">Кабинет</a></li>
                            <li><a href="<?= Html::encode(Url::to(['/auth/auth/logout'])) ?>" data-method="post">Выход</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li><a href="<?= Url::to(['/cabinet/wishlist/index']) ?>" id="wishlist-total"
                       title="Wish List"><i class="fa fa-heart"></i> <span class="hidden-xs hidden-sm hidden-md">Мои пожелания</span></a>
                </li>
                <li><a href="<?= Url::to(['/shop/cart/index']) ?>" title="Shopping Cart"><i
                                class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Корзина</span></a>
                </li>
                <li><a href="<?= Html::encode(Url::to(['/shop/checkout/index'])) ?>" title="Checkout"><i
                                class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md">Оформить заказ</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div id="logo">
                    <a href="<?= Url::home() ?>"><img
                                src="<?= Yii::getAlias('@web/image/logo.png') ?>" title="Your Store" alt="Your Store"
                                class="img-responsive"/></a>
                </div>
            </div>
            <div class="col-sm-5">
                <?= Html::beginForm(['/shop/catalog/search'], 'get') ?>
                <div id="search" class="input-group">
                    <input type="text" name="text" value="" placeholder="Search" class="form-control input-lg"/>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                <?= Html::endForm() ?>
            </div>
            <div class="col-sm-3">
                <?= CartWidget::widget() ?>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <?php
    NavBar::begin([
        'options' => [
            'screenReaderToggleText' => 'Menu',
            'id' => 'menu',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Каталог', 'url' => ['/shop/catalog/index']],
            ['label' => 'О компании', 'url' => ['/blog/post/index']],
            ['label' => 'Написать нам', 'url' => ['/contact/index']],
        ],
    ]);
    NavBar::end();
    ?>
</div>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h5>Information</h5>
                <ul class="list-unstyled">
                    <li><a href="/index.php?route=information/information&amp;information_id=4">About
                            Us</a></li>
                    <li><a href="/index.php?route=information/information&amp;information_id=6">Delivery
                            Information</a></li>
                    <li><a href="/index.php?route=information/information&amp;information_id=3">Privacy
                            Policy</a></li>
                    <li><a href="/index.php?route=information/information&amp;information_id=5">Terms
                            &amp; Conditions</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Наш сервис</h5>
                <ul class="list-unstyled">
                    <li><a href="/index.php?route=information/contact">Contact Us</a></li>
                    <li><a href="/index.php?route=account/return/add">Returns</a></li>
                    <li><a href="/index.php?route=information/sitemap">Site Map</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Extras</h5>
                <ul class="list-unstyled">
                    <li><a href="/index.php?route=product/manufacturer">Brands</a></li>
                    <li><a href="/index.php?route=account/voucher">Gift Certificates</a></li>
                    <li><a href="/index.php?route=affiliate/account">Affiliates</a></li>
                    <li><a href="/index.php?route=product/special">Specials</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Мой аккаунт</h5>
                <ul class="list-unstyled">
                    <li><a href="<?= Html::encode(Url::to(['/cabinet'])) ?>">Мой кабинет</a></li>
                    <li><a href="<?= Html::encode(Url::to(['/cabinet/order'])) ?>">Мои заказы</a></li>
                    <li><a href="<?= Html::encode(Url::to(['/cabinet/wishlist'])) ?>">Мои пожелания</a></li>
                    <li><a href="<?= Html::encode(Url::to(['/cabinet/newsletter'])) ?>">Новости</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <p>Powered By Yii2<br/> Your Store &copy; 2017</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
