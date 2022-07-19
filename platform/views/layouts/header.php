<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php
$Business=\common\models\Business::findOne(['id'=>Yii::$app->user->identity->bus_id]);
?>
<header class="main-header">

    <?= Html::a('<span class="logo-mini">'.$Business->name.'</span><span class="logo-lg">' .$Business->name. Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div style="float: left; line-height:50px;color: #fff">剩余天数：<?=ceil((strtotime($Business->endtime)-time())/86400)?>，如需续约请联系管理员：（13239283188）</div>
        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <span class="hidden-xs"><?=Yii::$app->user->identity->name?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li role="separator" class="divider"></li>
                        <li>
                            <?= Html::a(
                                '编辑信息',
                                ['business/update?id=1']
                            ) ?>
                        </li>
                        <li role="separator" class="divider"></li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <?= Html::a(
                                    '退出',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
