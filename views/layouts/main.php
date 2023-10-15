<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <!-- <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?> -->
    

<div class="container-fluid">
    <div class="row min-vh-100 flex-column flex-md-row">
        <div class="col-md-2 pr-md-0 bg-light">

        <div id="system-time" class="text-center mt-auto" style="background-color: #112A60; color: white; font-size: 30px;">
</div>

<script>
function updateSystemTime() {
    const systemTimeElement = document.getElementById('system-time');

    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const timeString = hours + ':' + minutes;
        systemTimeElement.innerText = timeString;
    }

    updateTime();
    setInterval(updateTime, 1000); // Update time every second
}

document.addEventListener('DOMContentLoaded', updateSystemTime);
</script>

            <nav class="navbar navbar-expand-md navbar-light flex-row flex-md-column align-items-start px-0">
                <a class="navbar-brand" href="/" style="background-color:#112A60">
                <!-- <img src="./tomas.png" alt="Tomas Image"> -->
                <img src="<?= Yii::getAlias('@web') ?>/tomas.png" alt="Tomas Image">
                <!-- <img src="<?= Yii::$app->urlManager->createUrl(['/assets/tomas.png']) ?>" alt="Tomas Image"> -->
                </a>
                <a class="navbar-toggler" href="#" data-toggle="collapse" data-target="#navbarToggle">
                    <span class="navbar-toggler-icon"></span>
                </a>
                <div class="collapse navbar-collapse ml-md-n2" id="navbarToggle">
    <?php
    NavBar::begin([
        //'brandLabel' => Yii::$app->name,
        //'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'collapse navbar-collapse ml-md-n2',
        ],
    ]);
        $menuItems[] = ['label' => 'Another', 'url' => ['/site/login']];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto flex-column'],
        'items' => [
            ['label' => 'Domov', 'url' => ['/site/index']],
            ['label' => 'TOMPROJECTS', 'url' => ['/site/tom-project']],
            ['label' => 'O nas', 'url' => ['/site/about']],
            Yii::$app->user->isGuest
                ? ['label' => 'Prijava', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ],
    ]);
    NavBar::end();
    ?>


                </div>
            </nav>
        </div>
        
        <div class="col pt-md-3" id="applicationContentContainer">
<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
        </div>
    </div>
</div>

</header>


<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
