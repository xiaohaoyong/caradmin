<aside class="main-sidebar">

    <section class="sidebar">
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => '管理目录', 'options' => ['class' => 'header']],
                    ['label' => '首页', 'icon' => 'file-code-o', 'url' => ['/'],],
                    [
                        'label' => '订单管理',
                        'icon' => '',
                        'url' => '/orders',
                    ],
                    [
                        'label' => '商品管理',
                        'icon' => '',
                        'url' => '/commodity',
                    ],
                    [
                        'label' => '库存管理',
                        'icon' => '',
                        'url' => '/goods',
                    ],
                    [
                        'label' => '员工管理',
                        'icon' => '',
                        'url' => '/staff',
                    ],
                    ['label' => '管理', 'options' => ['class' => 'header']],
                    [
                        'label' => '管理员',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '管理员列表', 'icon' => 'file-code-o', 'url' => ['/admin-business'],],
                            ['label' => '添加管理员', 'icon' => 'dashboard', 'url' => ['/admin-business/create'],],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
