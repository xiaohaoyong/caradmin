<?php

namespace platform\controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Yii;
use platform\models\Commodity;
use platform\models\CommoditySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class CommodityController extends Controller
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
    public function actionDown()
    {
        ini_set('memory_limit', '2048M');
        ini_set("max_execution_time", "0");
        set_time_limit(0);

        $searchModel = new CommoditySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet->getCellByColumnAndRow(1,1)->setValue('商品名称');
        $worksheet->getCellByColumnAndRow(2,1)->setValue('商品型号');
        $worksheet->getCellByColumnAndRow(3,1)->setValue('品牌');
        $worksheet->getCellByColumnAndRow(4,1)->setValue('适用车型');
        $worksheet->getCellByColumnAndRow(5,1)->setValue('指导价格');
        $i = 2;
        foreach ($dataProvider->query->all() as $k => $e) {
            $worksheet->getCellByColumnAndRow(1, $i)->setValue($e->name);
            $worksheet->getCellByColumnAndRow(2, $i)->setValue($e->goods_model);
            $worksheet->getCellByColumnAndRow(3, $i)->setValue($e->make);
            $worksheet->getCellByColumnAndRow(4, $i)->setValue($e->car_model);
            $worksheet->getCellByColumnAndRow(5, $i)->setValue($e->price);
            $i++;
        }


        ob_end_clean();
        ob_start();
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition:attachment;filename="商品列表-' . date("Y年m月j日") . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');


    }
    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CommoditySearch();
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
        $model = new Commodity();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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
        if (($model = Commodity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
