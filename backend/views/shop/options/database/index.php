<?php



use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Shop\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Базы данных';
$this->params['breadcrumbs'][] = ['label'=>'Options','url' => ['/shop/options/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
    <?= Html::a('Создать дамп БД (экспорт)', ['export'], ['class' => 'btn btn-success']) ?>
</p>
<div class="box">
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'dump',
                    'format' => 'text',
                    'label' => 'Путь к дампу БД',
                ],
                [
                    'format'=>'raw',
                    'value' => function($data,$id){
                        return Html::a('Импортировать в БД', \yii\helpers\Url::to(['shop/options/database/import','path'=>$data['dump']]), ['title' => 'Импортировать','class' => 'btn btn-primary']);
                    }
                ],
                [
                    'format'=>'raw',
                    //кнопку удаления выводим только если >1 дампа БД
                    'value' => function($data,$id){
                        if(Yii::$app->params['count_db'] > 1){
                            return Html::a('Удалить', \yii\helpers\Url::to(['shop/options/database/delete','path'=>$data['dump']]), ['title' => 'Удалить','class' => 'btn btn-danger']);
                        } else return false;
                    }
                ],
            ],
        ]); ?>
    </div>
</div>



