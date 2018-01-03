<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

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
                        'first_name',
                        'last_name',
                        'email:email',
                        'username',
                        'password_hash',
                        'mobile',
//            'auth_key',
//            'password_reset_token',
                        'created_on',
                        [
                            'attribute' => 'role',
                            'filter' => ArrayHelper::map(\common\models\AdminRoles::find()->distinct()->all(), 'id', 'role_name'),
                            'value' => function($data) {
                        if ($data->role == 0) {
                            return "";
                        } else {
                            return \common\models\AdminRoles::findOne($data->role)->role_name;
                        }
                    }
                        ],
                        'last_login',
                        [
                            'attribute' => 'status',
                            'filter' => [0 => "Disable", 10 => 'Enable'],
                            'value' => function($data) {
                        if ($data->status == 10) {
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
