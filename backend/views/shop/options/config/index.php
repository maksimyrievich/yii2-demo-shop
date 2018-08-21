<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 19.08.2018
 * Time: 4:58
 */

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\controllers\options\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = ['label' => 'Опции','url' => ['shop/options/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать настройку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class = table-responsive>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'param',
                'value:ntext',
                'default:ntext',
                'label',
                'type',

                ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}'],
            ],
        ]); ?>
    </div>


</div>