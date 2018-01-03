<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = 'Update Users: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-update">
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
