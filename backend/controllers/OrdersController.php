<?php

namespace backend\controllers;

use common\models\Goods;
use common\models\Model;
use common\models\OrdersGoods;
use common\models\User;
use Yii;
use common\models\Orders;
use backend\models\OrdersSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
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
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $file = \Yii::createObject([
//            'class' => 'codemix\excelexport\ExcelFile',
//            'sheets' => [
//                'Users' => [
//                    'class' => 'codemix\excelexport\ActiveExcelSheet',
//                    'query' => User::find(),
//                ]
//            ]
//        ]);
//        $file->send('user.xlsx');
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
}

    /**
     * Displays a single Orders model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();
        $goods = [new OrdersGoods()];

        if ($model->load(Yii::$app->request->post())) {

            $goods = Model::createMultiple(OrdersGoods::classname());
            Model::loadMultiple($goods, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($goods),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($goods) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {

                        foreach ($goods as $modelAddress) {
                            $modelAddress->orderid = $model->id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'goods' => (empty($goods)) ? [new OrdersGoods] : $goods

        ]);

    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $goods = $model->goods;


        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($goods, 'id', 'id');
            $goods = Model::createMultiple(OrdersGoods::classname(), $goods);
            Model::loadMultiple($goods, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($goods, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($goods),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($goods) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            OrdersGoods::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($goods as $modelAddress) {
                            $modelAddress->orderid = $model->id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'goods'=>$goods,
        ]);
    }

    public function actionSearchGoods($name){

        \Yii::$app->response->format=Response::FORMAT_JSON;
        $goods=Goods::find()->where(['like','name',$name])->all();
        foreach ($goods as $k=>$v){
            $orderGoodsNum=OrdersGoods::find()->where(['goodsid'=>$v->id])->count();
            $num=$v->stock-$orderGoodsNum;
            $rs['name']=$v->name;
            $rs['pic']=$v->price;
            $rs['num']=$num>=0?$num:0;
            $rs['id']=$v->id;
            $list[]=$rs;
        }

        return $list;
    }
    public function actionGoodsView($id){

        \Yii::$app->response->format=Response::FORMAT_JSON;
        $row=Goods::findOne($id);
        $rs['name']=$row->name;
        $rs['pic']=$row->price;
        $rs['goodsid']=$row->id;
        return $rs;

    }
    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
