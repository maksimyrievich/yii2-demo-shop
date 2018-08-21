<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 19.08.2018
 * Time: 4:58
 */

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\config\Config */

$this->title = 'Создать Настройку';
$this->params['breadcrumbs'][] = ['label' => 'Опции','url' => ['shop/options/list']];
$this->params['breadcrumbs'][] = ['label' => 'Настройки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>