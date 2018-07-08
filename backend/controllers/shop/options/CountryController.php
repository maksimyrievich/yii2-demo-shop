<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 06.07.2018
 * Time: 20:17
 */

namespace backend\controllers\shop\options;

use Yii;
use shop\entities\Shop\options\Country;
use yii\web\Controller;
use backend\forms\Shop\CountrySearch;

class CountryController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new CountrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'provider' => $dataProvider
        ]);
    }

    public function actionActivate()    {
        $model = new Country();
        $model = $model::findOne(['iso2' => Yii::$app->request->get('iso2')]);
        $model->setPublish(1);
        $model->save();
        Yii::$app->session->setFlash('success', 'Страна '. $model->getCountry() .' опубликована.');
        $this->redirect('/shop/options/country/index');
    }

    public function actionDeactivate()    {
        $model = new Country();
        $model = $model::findOne(['iso2' => Yii::$app->request->get('iso2')]);
        $model->setPublish(0);
        $model->save();
        Yii::$app->session->setFlash('success', 'Страна '. $model->getCountry().' снята с публикации.');
        $this->redirect('/shop/options/country/index');
    }

    public function actionAllactivate()
    {
        $model = new Country();
        $array = Yii::$app->db->createCommand('SELECT * FROM postcalc_light_countries')
            ->queryAll();
        foreach ($array as $key => $value) {
            foreach ($value as $index => $item){
                if($index == 'publish') {
                    $model = $model::findOne(['publish' => $item]);
                    $model->setPublish(1);
                    $model->save();
                }
            }
        }
        Yii::$app->session->setFlash('success', 'Все страны из списка опубликованы.');
        $this->redirect('/shop/options/country/index');
    }

    public function actionAlldeactivate()
    {
        $model = new Country();
        $array = Yii::$app->db->createCommand('SELECT * FROM postcalc_light_countries')
            ->queryAll();
        foreach ($array as $key => $value) {
            foreach ($value as $index => $item){
                if($index == 'publish') {
                    $model = $model::findOne(['publish' => $item]);
                    $model->setPublish(0);
                    $model->save();
                }
            }
        }
        Yii::$app->session->setFlash('success', 'Все страны из списка сняты с публикации.');
        $this->redirect('/shop/options/country/index');
    }



//                    echo "<pre>" ;print_r($item); echo "</pre>";





















}