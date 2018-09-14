<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

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
        'brandLabel' => 'Klienditeenindus',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'encodeLabels' => false,
        'items' => [
            ['label' => '<span class="glyphicon glyphicon-phone"></span> 1715'],
            ['label' => '<span class="glyphicon glyphicon-time"></span> E-P 9.00-21.00']
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    
                    ' <span class="glyphicon glyphicon-log-out"></span> LOG OUT',
                    ['class' => 'btn btn-warning logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => [
            Yii::$app->user->isGuest ? '':
            (['label' => 'Tere, ' . Yii::$app->user->identity->username])
        ],
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e4e4e4;">
            <a class="navbar-brand" href="<?php echo Url::to(['site/all']); ?>">My Actions</a>
            <a class="navbar-brand" href="<?php echo Url::to(['loan/all']); ?>">Loans</a>
            <a class="navbar-brand" href="<?php echo Url::to(['user/all']); ?>">Users</a>
        </nav>

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>

        <button type="button" class="btn btn-warning bottom">VAATAN SALDOSEISU</button>
        <button type="button" class="btn btn-danger bottom">MAKSAN VÖLGNEVUSE</button>
        <button type="button" class="btn btn-danger bottom">MAAKAN KOGU LAENU ÜHE MAKSEGA</button>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
