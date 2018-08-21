<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 19.08.2018
 * Time: 4:59
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\config\Config */

$this->title = 'Изменение: ' . $model->param;
$this->params['breadcrumbs'][] = ['label' => 'Опции','url' => ['shop/options/list']];
$this->params['breadcrumbs'][] = ['label' => 'Настройки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->param, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="config-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>