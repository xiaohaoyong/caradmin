<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-search">

    <?php $form = ActiveForm::begin([
            'id'=>'commodity',
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]); ?>


    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'goods_model') ?>

    <?= $form->field($model, 'make') ?>

    <?= $form->field($model, 'car_model') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'stock') ?>

    <?php // echo $form->field($model, 'createtime') ?>

    <?php // echo $form->field($model, 'updatetime') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        <?= Html::button('下载', ['id' => 'down', 'class' => 'btn btn-primary']) ?>
        <div class="help-block"></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$updateJs = <<<JS
jQuery("#down").click(function () {
        //过jquery为action属性赋值
        if(confirm("点击确定开始下载，请勿刷新或关闭窗口")){
            jQuery("#commodity").attr('action',"/commodity/down");    //通
            jQuery("#commodity").submit();    //提交ID为myform的表单
        }
    });
JS;
$this->registerJs($updateJs);
?>
