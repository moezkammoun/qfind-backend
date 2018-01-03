<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\AdminRoles */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Admin Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-roles-view">

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
                        'role_name',
                        [
                            'attribute' => 'cb',
                            'filter' => ArrayHelper::map(\common\models\Users::find()->distinct()->all(), 'id', 'first_name'),
                            'value' => function($data) {
                        if ($data->cb == 0) {
                            return "";
                        } else {
                            return \common\models\Users::findOne($data->cb)->first_name;
                        }
                    }
                        ],
                        [
                            'attribute' => 'ub',
                            'filter' => ArrayHelper::map(\common\models\Users::find()->distinct()->all(), 'id', 'first_name'),
                            'value' => function($data) {
                        if ($data->ub == 0) {
                            return "";
                        } else {
                            return \common\models\Users::findOne($data->ub)->first_name;
                        }
                    }
                        ],
                        'doc',
                        'dou',
                        [
                            'attribute' => 'category_access',
                            'filter' => [0 => "Disable", 1 => 'Enable'],
                            'value' => function($data) {
                        if ($data->category_access == 1) {
                            return "Enable";
                        } else {
                            return "Disable";
                        }
                    }
                        ],
                        [
                            'attribute' => 'advt_access',
                            'filter' => [0 => "Disable", 1 => 'Enable'],
                            'value' => function($data) {
                        if ($data->advt_access == 1) {
                            return "Enable";
                        } else {
                            return "Disable";
                        }
                    }
                        ],
                        [
                            'attribute' => 'cms_access',
                            'filter' => [0 => "Disable", 1 => 'Enable'],
                            'value' => function($data) {
                        if ($data->cms_access == 1) {
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
