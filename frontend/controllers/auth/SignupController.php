<?php
namespace frontend\controllers\auth;

use shop\useCases\auth\SignupService;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use shop\forms\auth\SignupForm;

class SignupController extends Controller
{
    public $layout = 'cabinet';

    private $service;

    public function __construct($id, $module, SignupService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['request','confirm'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    //Форма регистрации пользователя на сайте. URL:http://shop.dev/signup . Правило переадресации см. в
    //frontend/config/urlManager.php
    public function actionRequest()
    {
        //Создаем форму
        $form = new SignupForm();
        //Если форма загружена и провалидировалась
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            //Создаем конструкцию try-catch - она отлавливает все доменные исключения если они будут в процессе работы
            //наших сервисов
            try {
                //Выполняем сервисную функцию регистрации, передавая ей созданную форму в качестве аргумента
                $this->service->signup($form);
                Yii::$app->session->setFlash('success', 'Пройдите на Вашу почту для завершения регистрации.');
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('request', [
            'model' => $form,
        ]);
    }

    /**
     * @param $token
     * @return mixed
     */
    // На этот экшен мы попадаем со ссылки, которую формируем в сообщении отправляемом юзеру
    // См. common/auth/signup/confirm-html.php Приняли подтверждение, что емайл юзера настоящий.
    public function actionConfirm($token)
    {
        //Создаем конструкцию try-catch - она отлавливает все доменные исключения если они будут в процессе работы
        //наших сервисов
        try {
            //Выполняем сервисную функцию
            $this->service->confirm($token);
            Yii::$app->session->setFlash('success', 'Вы успешно зарегистрировались на нашем сайте. Мы выслали на ваш email - логин и пароль. Используйте их для входа на нашем сайте.');
            return $this->redirect(['auth/auth/login']);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->goHome();
    }
}
