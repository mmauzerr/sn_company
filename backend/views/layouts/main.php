<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="background-color: #dddddd">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'admin.S & N Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    // $menuItems = [
    //   ['label' => 'Home', 'url' => ['/site/index']],
    //  ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems = [
            ['label' => 'content', 'items' => [
                ['label'=> 'O Nama', 'url' => ['content/about-us']],
                ['label'=> 'Kontakt', 'url' => ['content/contact']],
                ['label'=> 'Kreiraj', 'url' => ['content/create']],
            //   ['label'=> 'Galerija - items', 'url' => ['content/galleryitems']],
                ['label'=> 'Kreiraj Glavnu Galeriju', 'url' => ['/content/create-main-gallery']],
                ['label'=> 'Glavna Galerija - index', 'url' => ['content/main-gallery']],
                ['label'=> 'Glavna Galerija - view', 'url' => ['content/main-gallery']],
            //    ['label'=> 'Update', 'url' => ['content/update']],
            ]],
            ['label' => 'Assessoris View', 'url' => ['#']],
            ['label' => 'Wooden Product', 'url' => ['#']],
            ['label' => 'CNC 88', 'url' => ['#']],
            ['label' => 'Create Product', 'url' => ['/product/create']],
            ['label' => 'Category', 'url' => ['/category/index']],
            ['label' => ''],['label' => ''],['label' => ''],['label' => ''],
        ];
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer" style="background-color: #818181 ">
    <div class="container">
        <p class="pull-left">&copy; S&N Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
