<?php

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" ocntent="noindex,nofollow">

        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>

        <link rel="stylesheet" href="">

        <?php $this->head() ?>
    </head>

    <body class="hold-transition login-page">
        <?php $this->beginBody() ?>

        <?= $content ?>

        <?php $this->endBody() ?>
    </body>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>
</html>
<?php $this->endPage() ?>


