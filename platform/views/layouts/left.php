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
                        'url' => '#',
                        'items' => [
                            ['label' => '员工列表', 'icon' => '', 'url' => ['/staff'],],
                            ['label' => '员工账单', 'icon' => '', 'url' => ['/orders?type=1'],],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
