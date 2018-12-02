<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\Blog\LastPostsWidget;
use frontend\widgets\Shop\FeaturedProductsWidget;
use yii\helpers\Url;

\frontend\assets\OwlCarouselAsset::register($this);

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="row">
    <div id="content" class="col-sm-12">
        <div id="slideshow0" class="owl-carousel" style="opacity: 1;">
            <div class="item">
                <a href="index.php?route=product/product&amp;path=57&amp;product_id=49"><img
                            src="<?=Url::to('@static/cache/banners/shlang2.jpg')?>"
                            alt="iPhone 6" class="img-responsive"/></a>
            </div>
            <div class="item">
                <img src="<?=Url::to('@static/cache/banners/shlang_red.jpg')?>"
                     alt="MacBookAir" class="img-responsive"/>
            </div>
        </div>
        <h3>Хиты продаж</h3>

        <?= FeaturedProductsWidget::widget([
            'limit' => 4,
        ]) ?>

        <h3>Каталог запчастей</h3>

        <?= LastPostsWidget::widget([
            'limit' => 4,
        ]) ?>

        <div id="carousel0" class="owl-carousel">
            <div class="item text-center">
                <img src="<?=Url::to('@static/cache/manufacturers/vaz_2114.jpg')?>" alt="NFL"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Url::to('@static/cache/manufacturers/vaz_2115.jpg')?>"
                     alt="RedBull" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Url::to('@static/cache/manufacturers/vaz_2107.jpg')?>" alt="Sony"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Url::to('@static/cache/manufacturers/vaz_2110.jpg')?>"
                     alt="Coca Cola" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Url::to('@static/cache/manufacturers/vaz_21214.jpg')?>"
                     alt="Burger King" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Url::to('@static/cache/manufacturers/vaz_chevrolet_niva.jpg')?>" alt="Canon"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Url::to('@static/cache/manufacturers/vaz_largus.jpg')?>"
                     alt="Harley Davidson" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Url::to('@static/cache/manufacturers/vaz_granta.jpg')?>" alt="Dell"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Url::to('@static/cache/manufacturers/disney-130x100.png')?>"
                     alt="Disney" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Url::to('@static/cache/manufacturers/starbucks-130x100.png')?>"
                     alt="Starbucks" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Url::to('@static/cache/manufacturers/nintendo-130x100.png')?>"
                     alt="Nintendo" class="img-responsive"/>
            </div>
        </div>
        <?= $content ?>
    </div>
</div>

<?php $this->registerJs('
$(\'#slideshow0\').owlCarousel({
    items: 1,
    loop: true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    nav: true,
    navText: [\'<i class="fa fa-chevron-left fa-5x"></i>\', \'<i class="fa fa-chevron-right fa-5x"></i>\'],
    dots: true
});') ?>

<?php $this->registerJs('
$(\'#carousel0\').owlCarousel({
    items: 6,
    loop: true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    nav: true,
    navText: [\'<i class="fa fa-chevron-left fa-5x"></i>\', \'<i class="fa fa-chevron-right fa-5x"></i>\'],
    dots: true
});') ?>

<?php $this->endContent() ?>