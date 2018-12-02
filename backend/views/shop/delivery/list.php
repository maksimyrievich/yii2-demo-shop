<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 06.07.2018
 * Time: 18:20
 */



$this->title = 'Способы доставки';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-md-12">
        <div class="box box-body">
            <div class="box-header">
            </div>
            <div class="box-body">
                <a class="btn btn-app" href="<?=Yii::$app->urlManager->createUrl(['shop/delivery/russianpost/index'])?>">
                    <i class="fa fa-truck"></i> Почта России
                </a>
                <a class="btn btn-app" href="<?=Yii::$app->urlManager->createUrl(['shop/delivery/pek/index'])?>">
                    <i class="fa  fa-truck" ></i> ПЭК
                </a>
                <a class="btn btn-app" href="<?=Yii::$app->urlManager->createUrl(['shop/delivery/delovielinii/index'])?>">
                    <i class="fa fa-truck"></i> Деловые линии
                </a>
                <a class="btn btn-app" href="<?=Yii::$app->urlManager->createUrl(['shop/delivery/energiya/index'])?>">
                    <i class="fa fa-truck"></i> Энергия
                </a>
                <a class="btn btn-app" href="<?=Yii::$app->urlManager->createUrl(['shop/delivery/jeldorekspediciya/index'])?>">
                    <i class="fa fa-truck"></i> ЖелДорЭкспедиция
                </a>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.col -->
</div>
<!-- ./row -->



