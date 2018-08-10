<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 07.07.2018
 * Time: 0:29
 */

namespace backend\controllers\shop\options;

use Yii;
use yii\helpers\FileHelper;
use yii\web\Controller;
use common\models\Db;

class DatabaseController extends Controller
{
    public $dumpPath = '@common/runtime/db/';

    public function actionIndex($path = null)
    {
        //Получаем массива путей к файлам с дампом БД (.sql)
        $path = FileHelper::normalizePath(Yii::getAlias($this->dumpPath));
        $files = FileHelper::findFiles($path, ['only' => ['*.sql'], 'recursive' => FALSE]);
        $model = new Db();
        //Метод формирует массив в нужный для виджета GridView формат с пагинацией
        $dataProvider = $model->getFiles($files);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionImport($path)
    {
        $model = new Db();
        //Метод делает импорт дампа БД
        $model->import($path);
        $this->redirect('/shop/options/database/index');
    }

    public function actionExport($path = null)
    {
        $path = $path ?: $this->dumpPath;
        $model = new Db();
        //Метод экспортирует данные из БД в указанную папку
        $model->export($path);
        $this->redirect('/shop/options/database/index');
    }

    public function actionDelete($path)
    {
        $model = new Db();
        //Метод удаляет дамп БД
        $model->delete($path);
        $this->redirect('/shop/options/database/index');
    }





}