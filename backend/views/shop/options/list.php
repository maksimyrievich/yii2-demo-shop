<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 06.07.2018
 * Time: 18:20
 */



$this->title = 'Options';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-md-12">
        <div class="box box-body">
            <div class="box-header">
            </div>
            <div class="box-body">
                <a class="btn btn-app" href="<?=Yii::$app->urlManager->createUrl(['shop/options/country/index'])?>">
                    <i class="fa fa-file-text-o"></i> Список стран
                </a>
                <a class="btn btn-app">
                    <i class="fa fa-bar-chart-o"></i> Статус заказа
                </a>
                <a class="btn btn-app" href="<?=Yii::$app->urlManager->createUrl(['shop/options/database/index'])?>">
                    <i class="fa  fa-database" ></i> Базы данных
                </a>
                <a class="btn btn-app">
                    <i class="fa fa-pause"></i> Pause
                </a>
                <a class="btn btn-app">
                    <i class="fa fa-save"></i> Save
                </a>
                <a class="btn btn-app">
                    <span class="badge bg-yellow">3</span>
                    <i class="fa fa-bullhorn"></i> Notifications
                </a>
                <a class="btn btn-app">
                    <span class="badge bg-green">300</span>
                    <i class="fa fa-barcode"></i> Products
                </a>
                <a class="btn btn-app">
                    <span class="badge bg-purple">891</span>
                    <i class="fa fa-users"></i> Users
                </a>
                <a class="btn btn-app">
                    <span class="badge bg-teal">67</span>
                    <i class="fa fa-inbox"></i> Orders
                </a>
                <a class="btn btn-app">
                    <span class="badge bg-aqua">12</span>
                    <i class="fa fa-envelope"></i> Inbox
                </a>
                <a class="btn btn-app">
                    <span class="badge bg-red">531</span>
                    <i class="fa fa-heart-o"></i> Likes
                </a>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.col -->
</div>
<!-- ./row -->



