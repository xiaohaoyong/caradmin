<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<div class="content">
    <div class="info-item">
        <div>
            <div class="info-title">
                下次养护
            </div>
            <div class="titem">订单时间：<?=date('Y/m/d H:i:s',strtotime($order->createtime))?></div>
            <div class="titem">当前里程：<?=$order->mileage?>km</div>

            <div class="red">建议下次养护：<?=$order->mileage+$order->interval_mileage?>公里</div>
        </div>
    </div>
    <div class="info-item">
        <div>
            <div class="info-title">
                养护材料
            </div>
            <div class="cail-list">
                <?php $total=0;foreach($orderGoods as $k=>$v){?>
                <div class="cail-item dfsb">
                    <div class="cail-title">
                        <div class="t"><?=$v->goods_name?></div>
                        <div class="i">
                            <span>数量：<?=$v->num?></span>
                            <span>单价：<?=$v->price?></span>
                        </div>
                    </div>
                    <div class="price">
                        <?=$v->total?>元
                        <?php
                        $total+=$v->total;
                        ?>
                    </div>
                </div>
                <?php }?>
            </div>
            <div class="di">
                <div>合计</div>
                <div><?=$total?>元</div>
            </div>
        </div>
    </div>
    <div class="info-item">
        <div>
            <div class="info-title">
                维修店/技工
            </div>
            <div class="titem">维修店：瑞森汽车养护服务中心 苏庄子店</div>
            <div class="titem">技工：<?=$order->worker?></div>
        </div>
    </div>
</div>