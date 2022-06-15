<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="orders-form">
    <div class="col-xs-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

                    <?= $form->field($model, 'orderid')->textInput(['maxlength' => true,'disabled'=>'disabled']) ?>

                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'customer')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'number')->textInput(['value'=>'陕K']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'vin')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'mileage')->textInput() ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'interval_mileage')->dropDownList(\common\models\Orders::$interval_mileageText,['prompt'=>'请选择']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'car_model')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'shop')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'worker')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <?= $form->field($model, 'remarks')->widget('kucha\ueditor\UEditor', []) ?>
                    </div>
                </div>
                    <?php
                    \wbraganca\dynamicform\DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
                        'limit' => 4, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $goods[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'goods_name',
                            'price',
                            'num',
                            'total',
                        ],
                    ]);
                    ?>
                <div class="container-items">
                    <?php foreach ($goods as $i => $modelAddress): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">商品</h3>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (! $modelAddress->isNewRecord) {
                                    echo Html::activeHiddenInput($modelAddress, "[{$i}]id",['value'=>0]);
                                }
                                ?>
                                <?= $form->field($modelAddress, "[{$i}]goodsid")->hiddenInput(['value'=>0])->label(false) ?>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <?= $form->field($modelAddress, "[{$i}]goods_name")->textInput(['maxlength' => true,'data-toggle' => 'modal','data-target' => '#ordergoods-modal','data-id'=>$i,'class'=>'form-control form-goods-name']) ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $form->field($modelAddress, "[{$i}]price")->textInput(['maxlength' => true,'class'=>'form-control form-goods-price']) ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $form->field($modelAddress, "[{$i}]num")->textInput(['maxlength' => true,'class'=>'form-control form-goods-num']) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?= $form->field($modelAddress, "[{$i}]total")->textInput(['maxlength' => true]) ?>
                                    </div>

                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                    <?php
                    \wbraganca\dynamicform\DynamicFormWidget::end()?>


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

<?php
$updateJs = <<<JS
    function SearchGoods(carid){
        var value=jQuery("#search-goods").val();
        jQuery.get('/orders/search-goods',{'name':value},function(e){
            var html="";
            e.forEach((elem, index) => {
                var html_item="<div class='goods-item row' data-id='"+elem.id+"'><div class='col-sm-7'>"+elem.name+"</div><div class='col-sm-3'>"+elem.pic+"</div><div class='col-sm-2'>"+elem.num+"</div></div>";
                html=html+html_item;
            });
            jQuery("#goods-list").html(html);
        });
    }
    jQuery("#search-goods").on("input", function(e, item) {
        SearchGoods(0);
    });
    jQuery("#goods-list").on("click",".goods-item", function(e, item) {
        var id=jQuery(this).attr("data-id");
        var goodsid=jQuery("#goods-list").attr("data-id");
        jQuery.get('/orders/goods-view',{'id':id},function(e){
            jQuery("input[name='OrdersGoods["+goodsid+"][goods_name]']").val(e.name);
            jQuery("input[name='OrdersGoods["+goodsid+"][price]']").val(e.pic);
            jQuery("input[name='OrdersGoods["+goodsid+"][goodsid]']").val(e.goodsid);
        });
                $('#ordergoods-modal').modal('hide');
    });
    jQuery(".container-items").on("input",".form-goods-num", function(e, item) {
        var num = jQuery(this).val();
        var id= jQuery('.form-goods-num').index(this);
        var pic = jQuery("input[name='OrdersGoods["+id+"][price]']").val();
        var total=num*pic;
        jQuery("input[name='OrdersGoods["+id+"][total]']").val(total);

    });
    jQuery(".container-items").on("input",".form-goods-price", function(e, item) {
        var pic = jQuery(this).val();
        var id= jQuery('.form-goods-price').index(this);
        var num = jQuery("input[name='OrdersGoods["+id+"][num]']").val();
        var total=num*pic;
        jQuery("input[name='OrdersGoods["+id+"][total]']").val(total);

    });
    jQuery(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
        console.log("beforeInsert");
    });

    jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
        console.log("afterInsert");
    });

    jQuery(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
        if (! confirm("Are you sure you want to delete this item?")) {
            return false;
        }
        return true;
    });

    jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
        console.log("Deleted item!");
    });

    jQuery(".dynamicform_wrapper").on("limitReached", function(e, item) {
        alert("Limit reached");
    });
$('#ordergoods-modal').on('show.bs.modal', function (event) {

  var button = $(event.relatedTarget); // Button that triggered the modal
  var id=button.data('id');
  jQuery('#goods-list').attr('data-id',jQuery('.form-goods-name').index(button));
})
JS;
$this->registerJs($updateJs);
?>
<?php
\yii\bootstrap\Modal::begin([
    'id' => 'ordergoods-modal',
    'header' => '<h5>选择商品</h5>',
]);
?>
    <div class="form-group">
        <label class="control-label">商品名称</label>
        <?=Html::textInput('goods_name','',['class'=>'form-control','id'=>'search-goods'])?>
    </div>
<div class="box">
    <style>
        .search-item{height: 30px;}
        .goods-item{padding: 10px 0;}
    </style>
    <div class="box-header">
        <div class="col-sm-4" style="text-align: center;">分类</div>
        <div class="col-sm-8">
            <div class="col-sm-6">商品</div>
            <div class="col-sm-3">价格</div>
            <div class="col-sm-3">数量</div>
        </div>
    </div>
    <div class="box-body">
        <div class="col-sm-4" style="height: 300px;background-color:#e3e3e3;border-radius: 5px;padding-top: 20px;overflow: hidden;overflow-y: auto;">
            <div class="search-item">轮胎</div>
            <div class="search-item">轮胎</div>
            <div class="search-item">轮胎</div>
            <div class="search-item">轮胎</div>
            <div class="search-item">轮胎</div>
            <div class="search-item">轮胎</div>
            <div class="search-item">轮胎</div>
            <div class="search-item">轮胎</div>
            <div class="search-item">轮胎</div>
            <div class="search-item">轮胎</div>
            <div class="search-item">轮胎</div>
            <div class="search-item">轮胎</div>
        </div>
        <div class="col-sm-8" id="goods-list">

        </div>
    </div>
</div>

<?php
\yii\bootstrap\Modal::end();
?>
