<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrdersGoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-goods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'goodsid') ?>

    <?= $form->field($model, 'orderid') ?>

    <?= $form->field($model, 'goods_name') ?>

    <?= $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'num') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        <div class="help-block"></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
