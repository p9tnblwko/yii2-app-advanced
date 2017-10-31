<?php

namespace backend\controllers;

use Yii;
use backend\models\Products;
use backend\models\ProductsSerach;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use \yii\web\HttpException;
use yii\filters\VerbFilter;
use backend\models\Amazon;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSerach();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post())) {
            // taking data from Amazon
            $call = new Amazon();
            $asin = Yii::$app->request->post('Products')['ASIN'];
            $response = $call->getProductByASIN($asin);
            $response = new \SimpleXMLElement($response);
            $isValid = (bool)$response->Items->Request->IsValid;
            $amount = (int)$response->Items->Item->OfferSummary->LowestNewPrice->Amount;
            $amount = $amount / 100;
            if(isset($response->Items->Item->LargeImage)){
                $image = $response->Items->Item->LargeImage->URL[0];
            }else{
                $length = count($response->Items->Item->ImageSets->ImageSet);
                $length = $length-1;
                $image = $response->Items->Item->ImageSets->ImageSet[$length]->LargeImage->URL[0];
            }
            if($isValid) {
                        $_POST['Products']['Title'] = (string)$response->Items->Item->ItemAttributes->Title;
                        $_POST['Products']['Price'] = (string)$amount;
                        $_POST['Products']['Picture'] = (string)$image;
                        $_POST['Products']['EAN'] = (string)$response->Items->Item->ItemAttributes->EAN;
                        $_POST['Products']['Brand'] = (string)$response->Items->Item->ItemAttributes->Brand;
                Yii::$app->request->setBodyParams($_POST);

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    throw new HttpException(500 ,'Something is wrong, please try again.');
                }
            }else{
                throw new HttpException(404 ,'ASIN not found');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
