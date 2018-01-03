<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">
    <section class="content-header">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

        <ol class="breadcrumb">

            <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <?php Pjax::begin(); ?>                                    <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
//                                'id',
                        'first_name',
//                        'last_name',
                        'email:email',
                        'username',
                        // 'password_hash',
                        // 'mobile',
//                        'status',
                        // 'auth_key',
                        // 'password_reset_token',
                        // 'created_on',
//                        'role',
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
                        //['class' => 'yii\grid\ActionColumn'],
                        ['class' => 'yii\grid\ActionColumn',
                            'header' => 'view',
                            'template' => '{view}'],
                        ['class' => 'yii\grid\ActionColumn',
                            'header' => 'update',
                            'template' => '{update}'],
                        ['class' => 'yii\grid\ActionColumn',
                            'header' => 'delete',
                            'template' => '{delete}',
                        ],
                    ],
                ]);
                ?>
                <?php Pjax::end(); ?>            </div>
        </div>
    </section>
</div>
