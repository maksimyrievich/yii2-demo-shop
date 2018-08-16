<?php

namespace frontend\controllers\shop;

use shop\cart\Cart;
use shop\services\delivery\russianpost\RussianPost;
use shop\forms\Shop\Order\CustomerForm;
use shop\repositories\UserRepository;
use shop\useCases\Shop\OrderService;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\db\Query;
use shop\entities\Shop\options\Cities;
use yii\web\Response;



class CheckoutController extends Controller
{
    public $layout = 'blank';

    private $service;
    private $cart;

    private $user;

    public function __construct($id, $module, OrderService $service, UserRepository $user, Cart $cart, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->cart = $cart;
        $this->user = $user;
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        if($this->cart->getItems()){
            $form = new CustomerForm($this->cart->getWeight());
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                try {
                    $order = $this->service->checkout(Yii::$app->user->id, $form);
                    return $this->redirect(['/cabinet/order/view', 'id' => $order->id]);
                } catch (\DomainException $e) {
                    Yii::$app->errorHandler->logException($e);
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            }

            $session = Yii::$app->session;
            $tmp = $session['user.townru'];
            $form->imya = $session['user.imya'];
            $form->country = $session['user.country'];
            $form->town = $session['user.town'];
            $form->street = $session['user.street'];
            $form->indexru = $session['user.indexru'];
            $form->index = $session['user.index'];
            $form->phone = $session['user.phone'];

            return $this->render('index', [
                'cart' => $this->cart,
                'model' => $form,
                'tmp' => $tmp
            ]);
        }else{
            Yii::$app->session->setFlash('error', 'Ваша корзина пуста');
            return $this->redirect(['/shop/cart/index']);
        }

    }

    //Экшен ищет город в базе данных городов через Ajax запросы из Kartic Select2 плагина
    public function actionCitylist($q = '', $id = null) {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('pindex as id, city as text')
                ->from('postcalc_light_cities')
                ->where(['like', 'city', $q.'%', false])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Cities::findOne(['pindex' => $id])->city];
        }
        return $out;
    }

    //Экшен ищет индекс в базе данных индексов через Ajax запросы из Kartic Select2 плагина
    public function actionIndexlist($q = '', $id = null) {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('pindex as id, opsname as text')
                ->from('postcalc_light_post_indexes')
                ->where(['like', 'pindex', $q.'%', false])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
            foreach ($out['results'] as $key => $value)
            {
                $i=0;
                foreach ($value as $k =>$item)
                {
                    $i++;
                    if($i == 1)
                    {
                        $array['results'][$key][$k]= $item;
                        $temp = $item;
                    }
                    if($i == 2)
                    {
                        $array['results'][$key][$k]= $temp.' ('.$item.')';
                        $i = 0;
                    }
                }
            }
            $out = $array;
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Cities::findOne($id)];
        }

        return $out;
    }

    public function actionSend(){

        $form = new CustomerForm($this->cart->getWeight());

        if($form->load(Yii::$app->request->post()) && $form->validate())
        {
            $tmp = Cities::findOne(['pindex' => $form->townru]);
            $session = Yii::$app->session;
            $session->open();
            $session['user.imya'] = $form->imya;
            $session['user.country'] = $form->country;
            $session['user.town'] = $form->town;
            $session['user.townru'] = $tmp;
            $session['user.street'] = $form->street;
            $session['user.indexru'] = $form->indexru;
            $session['user.index'] = $form->index;
            $session['user.phone'] = $form->phone;
        }


        // Обращаемся к функции getPostcalc
        $temp = new RussianPost();
        $arrResponse = $temp->postcalc_request('413860',"413801", 1000, 0, 'RU');






        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['form' =>   ['error' => ['all' => $form->hasErrors() ? 1 : 0 ,
                                         'email' => ['bool' => $form->hasErrors('email') ? 1 : 0,
                                                     'text' => $form->getFirstError('email'),
                                                     'ru_post' => $arrResponse
                                                    ],
                                         'phone' => [$form->hasErrors('phone') ? 1 : 0,
                                                     'bool' => $form->hasErrors('phone') ? 1 : 0,
                                                     'text' => $form->getFirstError('phone')
                                                    ],
                                         ],
                            ],
               ];
    }
}