<?php

/* @var $this yii\web\View */

$this->title = '首页';

$Business=\common\models\Business::findOne(['id'=>Yii::$app->user->identity->bus_id]);
?>
<div class="site-index">

    <section class="content">
        <img src="http://web.wzgeek.com/<?=$Business->img?>" width="100%">
    </section>
    <script>

    </script>
</div>
<?php
\yii\bootstrap\Modal::begin([
    'id' => 'modal',
    'options'=>[
        'data-backdrop'=>'static',//点击空白处不关闭弹窗
        'data-keyboard'=>false,
        'data-dismiss'=>false,
    ],
]);
?>
<div class="modal-body">
    <div style="text-align: center;line-height: 30px">开通时间：<?=$Business->starttime?></div>
    <div style="text-align: center;line-height: 30px">结束时间：<?=$Business->endtime?></div>
    <div style="text-align: center;line-height: 26px;font-size: 16px;margin-top: 50px">系统即将到期，为了不影响您的使用，<br>请联系管理员（13239283188）修改到期时间</div>
</div>
<?php
$day=ceil((strtotime($Business->endtime)-time())/86400);
\yii\bootstrap\Modal::end();
$updateJs = <<<JS
    var day = {$day};
    if(day < 30){
        $("#modal").modal('show');
    }
JS;
$this->registerJs($updateJs);
?>


