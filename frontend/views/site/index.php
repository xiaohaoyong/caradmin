<?php
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="header">

</div>
<div class="content">
    <div class="title">
        <div class="info">
            <div class="t">瑞森汽车服务</div>
            <div class="t2">您的爱车管家</div>
        </div>
        <div class="img">
            <img src="/img/loge.png" width="59">
        </div>
    </div>
    <?php $form =ActiveForm::begin(); ?>

    <div class="login">
        <div class="input">
            <?= \yii\bootstrap\Html::input('text', 'phone', '', ['placeholder'=>'请输入手机号']) ?>
        </div>
        <div class="input">
            <?= \yii\bootstrap\Html::input('text', 'car', '', ['placeholder'=>'请输入车牌号']) ?>
        </div>

    </div>
    <?= \yii\bootstrap\Html::submitButton('登录') ?>
    <?php ActiveForm::end(); ?>

</div>