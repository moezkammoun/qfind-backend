<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AdminRoles */

$this->title = 'Update Admin Roles: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Admin Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-roles-update">
    <section class="content-header">

        <h1><?= Html::encode($this->title) ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">


                <?= $this->render('_form', [
                'model' => $model,
                ]) ?>
            </div>
        </div>
    </section>
</div>
