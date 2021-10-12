<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2021/10/12
 * Time: 7:29 PM
 */

namespace backend\controllers;


use common\models\Orders;

class Controller extends \yii\web\Controller
{
    private $notCheckAccess = ['/rbac/access-error', 'site/index'];

    private $ignore = [
        'site/login', 'site/logout','site/captcha'
    ];
    public $orderTodayTotal;
    public $orderTotal;

    public function beforeAction($action)
    {
        parent::beforeAction($action);

        $path = \Yii::$app->request->pathInfo;

        if (in_array($path, $this->ignore))
        {
            return true;
        }

        if(\Yii::$app->user->isGuest)
        {
            return $this->redirect(\Yii::$app->user->loginUrl)->send();
        }

        $moduleId = \Yii::$app->controller->module->id === \Yii::$app->id ? '' : \Yii::$app->controller->module->id . '/';
        $controllerId = \Yii::$app->controller->id . '/';
        $actionId = \Yii::$app->controller->action->id;

        $permissionName = $moduleId . $controllerId . $actionId;
        $notCheckAccess = join('|', $this->notCheckAccess);

        $orderToday=Orders::find()->select('id')->where(['>=','createtime',date('Y-m-d 00:00:00')])->andWhere(['<=','createtime',date('Y-m-d 00:00:00')])->column();
        \Yii::$app->params['orderTodayTotal']=\common\models\OrdersGoods::find()->where(['orderid'=>$orderToday])->sum('total');
        $order=Orders::find()->select('id')->column();
        \Yii::$app->params['orderTotal']=\common\models\OrdersGoods::find()->where(['orderid'=>$order])->sum('total');


        // 如果是登录或退出动作
        if (stripos('/site/login|/site/logout', $permissionName) !== false) {
            return true;
        }
        return true;
    }

}