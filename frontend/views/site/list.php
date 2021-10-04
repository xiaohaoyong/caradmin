<?php

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
    <div class="info-item">
        <div>
            <div class="info-title">
                基本信息
            </div>
            <div class="item-list">
            <div class="item">姓名：<?=$order[0]->customer?></div>
            <div class="item">车牌号：<?=$order[0]->number?></div>
            <div class="item">手机号：<?=$order[0]->phone?></div>
            </div>
        </div>
    </div>
    <div class="info-item">
        <div>
            <div class="info-title">
                下次养护
            </div>
            <div class="red">建议下次养护：<?=$order[0]->mileage+$order[0]->interval_mileage?>公里</div>
        </div>
    </div>
    <?php
    foreach($order as $k=>$v){
    ?>
        <a href="/site/view?id=<?$v->id?>">
    <div class="info-item dfsb">
        <div>
            <div class="info-title">
                <?=date('Y/m/d',strtotime($v->createtime))?>
            </div>
            <div><span class="red">已完成</span> 点击查看详情</div>
        </div>
        <div class="j">
            >
        </div>
    </div>
        </a>
    <?php }?>
</div>