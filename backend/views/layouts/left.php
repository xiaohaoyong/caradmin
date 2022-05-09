<aside class="main-sidebar">

    <section class="sidebar">


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => '管理目录', 'options' => ['class' => 'header']],
                    [
                        'label' => '首页',
                        'icon' => '',
                        'url' => '/',
                    ],
                    [
                        'label' => '订单管理',
                        'icon' => '',
                        'url' => '/orders',
                    ],
                    [
                        'label' => '商品管理',
                        'icon' => '',
                        'url' => '/goods',
                    ],
                    [
                        'label' => '库存管理',
                        'icon' => '',
                        'url' => '/goods',
                    ],
                    [
                        'label' => '商户管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '商户管理', 'icon' => 'file-code-o', 'url' => ['/business'],],
                            ['label' => '添加用户', 'icon' => 'dashboard', 'url' => ['/business/create'],],
                            ['label' => '商户管理员列表', 'icon' => 'dashboard', 'url' => ['/admin-business'],],
                            ['label' => '添加管理员', 'icon' => 'dashboard', 'url' => ['/admin-business/create'],],

                        ],
                    ],
                    [
                        'label' => '账户管理',
                        'icon' => '',
                        'url' => '/user',
                    ],
                ],
            ]
        ) ?>

    </section>
    <div style="color: #ffffff;margin-top: 100px; display: flex;flex-direction: column; justify-content: center; align-items: center;">
        <div>日销售额：<?=\Yii::$app->params['orderTodayTotal']?\Yii::$app->params['orderTodayTotal']:0?></div>
        <div>总销售额：<?=\Yii::$app->params['orderTotal']?></div>
    </div>
</aside>
