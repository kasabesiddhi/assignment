<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Customer;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Customer::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
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
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->c_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->c_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Customer model.
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
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSort(){
      $name = $_GET['name'];
      $email = $_GET['email'];
      $age = $_GET['age'];
    //  echo 'Age is '.$diff->format('%y');exit;
        $timestamp = strtotime('-25 years');
        $date =   date('Y-m-d', $timestamp);
        
      if($age ==1){
          $condition1= "AND c_dob > '$date'";
      }else if($age== 2){
          $condition1 = "AND c_dob <= '$date'";
      }else{
          $condition1 = " ";
      }if($email != ""){
          $condition2 = "AND c_email like '%$email%'";
      }else{
          $condition2 = "";
      }if($name !=""){
          $condition3 = "AND c_name like '%$name%'";
      }else{
          $condition3 ="";
      }
              $customers  = Yii::$app->db->createCommand("select * from customer where c_id!=0 $condition1  $condition2 $condition3")->queryAll();
              $customer_id = ArrayHelper::getColumn($customers, 'c_id');
              $query = \frontend\models\Customer::find()
                ->where(['in', 'c_id', $customer_id])
                ->orderBy([
            'c_id' => SORT_DESC,
        ]);
              $dataProvider = new ActiveDataProvider([
            'query' => $query,
                  'pagination' => [
        'pageSize' => 5,
    ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
      }
}
