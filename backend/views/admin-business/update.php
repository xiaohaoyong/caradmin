<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AdminBusiness */

$this->title ='编辑';
$this->params['breadcrumbs'][] = ['label' => 'Admin Businesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

\common\helpers\HeaderActionHelper::$action=[
0=>['name'=>'列表','url'=>['index']],
1=>['name'=>'添加','url'=>['create']]
];
?>
<div class="admin-business-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
