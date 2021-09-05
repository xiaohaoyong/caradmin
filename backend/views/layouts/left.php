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
                        'label' => '账户管理',
                        'icon' => '',
                        'url' => '/user',
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
