<?php

use shop\entities\Shop\Order\Order;
use shop\helpers\OrderHelper;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои заказы';
$this->params['breadcrumbs'][] = ['label' => 'Мой кабинет', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => 'id',
                        'value' => function (Order $model) {
                            return Html::a(Html::encode($model->id), ['view', 'id' => $model->id],['class'=> 'label label-default']);
                        },
                        'format' => 'raw',
                    ],
                    'created_at:datetime',
                    [
                        'attribute' => 'statuses',
                        'value' => function (Order $model) {
                            foreach ($model->statuses as $status){
                                $data = $status->value;
                            }
                            return OrderHelper::statusLabel($data);
                        },

                        'format' => 'raw',
                    ],
                    ['class' => ActionColumn::class,
                        'template' => '{view}',
                        'buttons' => [
                                'view' => function($url, $model, $key){
                                    return Html::a('ДЕТАЛИ', [$url], ['class' => 'label label-primary']);}]],
                ],
            ]); ?>
        </div>
    </div>
</div>
