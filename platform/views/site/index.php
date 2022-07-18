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
