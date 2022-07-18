<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Business */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-form">
    <div class="col-xs-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($file, 'file')->fileInput() ?>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? '提交'                    : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' :
                    'btn btn-primary']) ?>
                </div>
                <img src="http://web.wzgeek.com/<?=$model->img?>" width="100%">

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
