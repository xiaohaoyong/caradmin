<?php

namespace platform\controllers;

use common\models\GoodsCategory;
use Yii;
use platform\models\Goods;
use platform\models\GoodsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends Controller
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
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goods model.
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
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $post=Yii::$app->request->post();
        $model = new Goods();

        if($post){

            //var_dump(Yii::$app->request->post());exit;
            $model->load(Yii::$app->request->post());
            if($model->save()){

                if($post['category']){
                    GoodsCategory::deleteAll(['goods_id'=>$model->id]);
                    foreach ($post['category'] as $k=>$v){
                        $data[$k][]=$model->id;
                        $data[$k][]=$v;
                    }
                    Yii::$app->db->createCommand()->batchInsert(GoodsCategory::tableName(), ['goods_id','cat_id'],
                        $data
                    )->execute();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post=Yii::$app->request->post();

        if($post){

            //var_dump(Yii::$app->request->post());exit;
            $model->load(Yii::$app->request->post());
            if($model->save()){

                if($post['category']){
                    GoodsCategory::deleteAll(['goods_id'=>$model->id]);
                    foreach ($post['category'] as $k=>$v){
                        $data[$k][]=$model->id;
                        $data[$k][]=$v;
                    }
                    Yii::$app->db->createCommand()->batchInsert(GoodsCategory::tableName(), ['goods_id','cat_id'],
                        $data
                    )->execute();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Goods model.
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
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
