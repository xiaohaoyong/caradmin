<?php

/* @var $this yii\web\View */

$this->title = '首页';
platform\assets\IndexAsset::register($this);
?>
<?php
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
\common\models\Model::begin([
    'id' => 'modal',
    'header' => '<h4 class="modal-title">创建</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
]);
echo 121212;
\common\models\Model::end();
$updateJs = <<<JS
    jQuery("#modal").modal('show');
JS;
$this->registerJs($updateJs);
?>
