<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 06.07.2018
 * Time: 18:17
 */

namespace backend\controllers\shop;


use yii\web\Controller;

class OptionsController extends Controller
{

    public function actionList()
{


    return $this->render('list', []);
}
}