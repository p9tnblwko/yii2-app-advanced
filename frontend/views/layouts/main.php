<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/img/logo.jpg',['class'=>'logo']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => '',
        ],
    ]);
    $menuItems = [
        ['label' => 'ReviewScore', 'url' => ['/']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        $menuItems[] = '<li><a href="http://techfunder-backend.dev/"><button type="button" class="btn btn-info">für händler</button></a></li>';
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fliud">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <?= Html::img('@web/img/footer-logo.jpg',['class'=>'logo']) ?>
        <p class="text-center">Copyright &copy; 2015 - <?= date('Y') ?> Review Bridge Research GmbH - Alle Rechte vorbehalten</p>

        <ul>
            <li class="pull-left"><a href="#">Einfach.Kaufen</a></li>
            <li class="pull-left"><a href="#">Impressum</a></li>
            <li class="pull-left"><a href="#">Datenschutz</a></li>
            <li class="pull-left"><a href="#">Kontakt</a></li>
            <li class="pull-left"><a href="#">Agb Verbraucher</a></li>
            <li class="pull-left"><a href="#">Agb Händler</a></li>
        </ul>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
