<?php

namespace frontend\controllers;

use common\models\Orders;
use common\models\OrdersGoods;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $post=Yii::$app->request->post();
        if($post){
           $phone=$post['phone'];
           $car=$post['car'];
           $order=Orders::find()->where(['phone'=>$phone,'number'=>$car])->orderBy('id desc')->all();
            return $this->render('list',[
                'order' => $order,
            ]);
        }
        return $this->render('index');
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionList()
    {
        return $this->render('list');
    }
    public function actionView($id)
    {
        $order=Orders::findOne($id);
        $orderGoods=OrdersGoods::findAll(['orderid'=>$id]);
        return $this->render('view',['order' => $order,'orderGoods'=>$orderGoods]);
    }

}
