<?php

namespace backend\controllers\shop;

use shop\entities\Shop\Product\Modification;
use shop\forms\manage\Shop\Product\QuantityForm;
use shop\forms\manage\Shop\Product\PhotosForm;
use shop\forms\manage\Shop\Product\PriceForm;
use shop\forms\manage\Shop\Product\TagsForm;
use shop\forms\manage\Shop\Product\ValueForm;
use shop\entities\Shop\Characteristic;
use shop\forms\manage\MetaForm;
use shop\forms\manage\Shop\Product\CategoriesForm;
use shop\forms\manage\Shop\Product\ProductCreateForm;
use shop\forms\manage\Shop\Product\ProductEditForm;
use shop\useCases\manage\Shop\ProductManageService;
use Yii;
use shop\entities\Shop\Product\Product;
use backend\forms\Shop\ProductSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ProductController extends Controller
{
    private $service;

    public function __construct($id, $module, ProductManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'activate' => ['POST'],
                    'draft' => ['POST'],
                    'delete-photo' => ['POST'],
                    'move-photo-up' => ['POST'],
                    'move-photo-down' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $product = $this->findModel($id);

        $modificationsProvider = new ActiveDataProvider([
            'query' => $product->getModifications()->orderBy('name'),
            'key' => function (Modification $modification) use ($product) {
                return [
                    'product_id' => $product->id,
                    'id' => $modification->id,
                ];
            },
            'pagination' => false,
        ]);

        $photosForm = new PhotosForm();
        if ($photosForm->load(Yii::$app->request->post()) && $photosForm->validate()) {
            try {
                $this->service->addPhotos($product->id, $photosForm);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('view', [
            'product' => $product,
            'modificationsProvider' => $modificationsProvider,
            'photosForm' => $photosForm,
        ]);
    }


    /**
     * @return string|\yii\web\Response
     * @throws \Exception
     */
    public function actionCreate()
    {
        $form = new ProductCreateForm();
        $form->price = new PriceForm();
        $form->quantity = new QuantityForm();
        $form->meta = new MetaForm();
        $form->categories = new CategoriesForm();
        $form->photos = new PhotosForm();
        $form->tags = new TagsForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate() &&
            $form->price->load(Yii::$app->request->post()) && $form->price->validate() &&
            $form->quantity->load(Yii::$app->request->post()) && $form->quantity->validate() &&
            $form->meta->load(Yii::$app->request->post()) && $form->meta->validate() &&
            $form->categories->load(Yii::$app->request->post()) && $form->categories->validate() &&
            $form->photos->load(Yii::$app->request->post()) && $form->photos->validate() &&
            $form->tags->load(Yii::$app->request->post()) && $form->tags->validate()
        ) {
            try {
                $form = $this->service->create($form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }


    public function actionUpdate($id)
    {
        $product = $this->findModel($id);

        $form = new ProductEditForm($product);
        //$form->meta = new MetaForm($product->meta);
        $form->categories = new CategoriesForm($product);
        //$form->tags = new TagsForm($product);

        if ($form->load(Yii::$app->request->post()) && $form->validate() &&
            //$form->meta->load(Yii::$app->request->post()) && $form->validate() &&
            $form->categories->load(Yii::$app->request->post()) && $form->validate() //&&
            //$form->tags->load(Yii::$app->request->post()) && $form->validate()
        ) {
            try {
                $this->service->edit($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'product' => $product,
        ]);
    }


    public function actionPrice($id)
    {
        $product = $this->findModel($id);

        $form = new PriceForm($product);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->changePrice($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('price', [
            'model' => $form,
            'product' => $product,
        ]);
    }


    public function actionQuantity($id)
    {
        $product = $this->findModel($id);

        $form = new QuantityForm($product);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->changeQuantity($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('quantity', [
            'model' => $form,
            'product' => $product,
        ]);
    }


    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionActivate($id)
    {
        try {
            $this->service->activate($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDraft($id)
    {
        try {
            $this->service->draft($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * @param integer $id
     * @param $photo_id
     * @return mixed
     */
    public function actionDeletePhoto($id, $photo_id)
    {
        try {
            $this->service->removePhoto($id, $photo_id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    /**
     * @param integer $id
     * @param $photo_id
     * @return mixed
     */
    public function actionMovePhotoUp($id, $photo_id)
    {
        $this->service->movePhotoUp($id, $photo_id);
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    /**
     * @param integer $id
     * @param $photo_id
     * @return mixed
     */
    public function actionMovePhotoDown($id, $photo_id)
    {
        $this->service->movePhotoDown($id, $photo_id);
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    /**
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Product
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
