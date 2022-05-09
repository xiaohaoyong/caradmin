<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-form">
    <div class="col-xs-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'goods_model')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'make')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'car_model')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <?php $category=\common\models\GoodsCategory::find()->select('cat_id')->where(['goods_id'=>$model->id])->column();?>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group field-category">
                            <label class="control-label" for="category">分类</label>
                            <?= \kartik\select2\Select2::widget([
                                'name' => 'category',
                                'data' => \common\models\Category::find()->where(['bus_id'=>Yii::$app->user->identity->bus_id])->select('name')->indexBy('id')->column(),
                                'language' => 'de',
                                'options' => ['placeholder' => '请选择', 'multiple' => 'multiple'],
                                'showToggleAll' => false,
                                'value' =>$category,
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])?>
                            <div class="help-block"></div>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <a href="/category/create">添加分类</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'stock')->textInput() ?>
                    </div>
                </div>





    <?= $form->field($model, 'createtime')->textInput(['disabled'=>'disabled']) ?>

    <?= $form->field($model, 'updatetime')->textInput(['disabled'=>'disabled']) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? '提交'                    : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' :
                    'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
