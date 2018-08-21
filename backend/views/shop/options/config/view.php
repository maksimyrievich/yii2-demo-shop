<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 19.08.2018
 * Time: 5:00
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\config\Config */

$this->title = $model->param;
$this->params['breadcrumbs'][] = ['label' => 'Опции','url' => ['shop/options/list']];
$this->params['breadcrumbs'][] = ['label' => 'Настройки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-view">

    <h1><?= Html::encode($model->param) ?></h1>

    <p>
        <?= Html::a('Назад', ['shop/options/config/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <!--<?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> -->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'param',
            'value:ntext',
            'default:ntext',
            'label',
            'type',
        ],
    ]) ?>

</div>