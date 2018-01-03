<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CategoriesMaster */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>

    .box-body img {
        width: 48px !important;
    }
</style>
<div class="categories-master-view">

    <section class="content-header">

        <h1><?= Html::encode($this->title) ?></h1>

        <ol class="breadcrumb">

            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">

                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'name',
                        'canonical_name',
                        [
                            'attribute' => 'parent_id',
//                            'filter' => ArrayHelper::map(\backend\models\CategoriesMaster::find()->where([''])->distinct()->all(), 'id', 'role_name'),
//                            'filter' => [1 => "Category", 2 => 'Sub Category'],
                            'value' => function($data) {
                        if ($data->leval == 1) {
                            return "Top Leval Category";
                        } else {
                            return \backend\models\CategoriesMaster::findOne($data->parent_id)->name;
                        }
                    }
                        ],
                        [
                            'attribute' => 'leval',
//                            'filter' => ArrayHelper::map(\common\models\AdminRoles::find()->distinct()->all(), 'id', 'role_name'),
                            'filter' => [1 => "Category", 2 => 'Sub Category'],
                            'value' => function($data) {
                        if ($data->leval == 1) {
                            return "Category";
                        } else {
                            return 'Sub Category';
                        }
                    }
                        ],
                        [
                            'attribute' => 'icon',
//                            'filter' => ArrayHelper::map(\common\models\AdminRoles::find()->distinct()->all(), 'id', 'role_name'),
                            'filter' => [1 => "Category", 2 => 'Sub Category'],
                            'value' => function($data) {
                        if ($data->icon == '') {
                            return "Not Set";
                        } else {
                            return Yii::$app->request->baseUrl . "/../uploads/categories-master/" . $data->id . '/icon/' . $data->icon;
                        }
                    },
                            'format' => 'image',
                        ],
                        [
                            'attribute' => 'status',
                            'filter' => [0 => "Disable", 1 => 'Enable'],
                            'value' => function($data) {
                        if ($data->status == 1) {
                            return "Enable";
                        } else {
                            return "Disable";
                        }
                    }
                        ],
                    ],
                ])
                ?>

            </div>
        </div>
    </section>
</div>
