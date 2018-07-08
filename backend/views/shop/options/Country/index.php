<?php


use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Shop\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список стран';
$this->params['breadcrumbs'][] = ['label'=>'Options','url' => ['/shop/options/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <p>
        <?=Html::a('Выбрать всё',['/shop/options/country/allactivate'],['class'=> 'btn btn-success'])?>
        <?=Html::a('Снять всё',['/shop/options/country/alldeactivate'],['class'=> 'btn btn-danger'])?>
    </p>
    <div class="box">
        <div class="box-body">

                <?= GridView::widget([
                    'dataProvider' => $provider,
                    'filterModel' => $searchModel,
                    'columns' => [

                        [
                            'attribute' => 'iso2',
                            'format' => 'text',

                        ],
                        [
                            'attribute' => 'country',
                            'format' => 'text',

                        ],
                        // Другой вариант
                        [
                            'attribute' => 'publish',
                            'filter'=>array("1"=>"Опубликовано","0"=>"Не опубликовано"),
                            'content' => function ($model, $key, $index, $column) {
                                if(($model->getPublish() == null) || ($model->getPublish() == 0)){
                                    return Html::a('<span class="glyphicon glyphicon-remove"></span>',['/shop/options/country/activate', 'iso2'=> $model->getIso2()],['class'=> 'btn btn-danger btn-xs']);
                                }else{
                                    return Html::a('<span class="glyphicon glyphicon-ok"></span>',['/shop/options/country/deactivate', 'iso2'=> $model->getIso2()],['class'=> 'btn btn-success btn-xs']);
                                }

                            }

                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
