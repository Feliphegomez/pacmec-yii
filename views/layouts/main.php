<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<?php
NavBar::begin([
    // 'brandLabel' => Yii::$app->name,
    // 'brandUrl' => Yii::$app->homeUrl,
    'options' => ['class' => 'navbar navbar-expand-sm navbar-light bg-light'],
    'innerContainerOptions' => ['class' => 'container-fluid'],
]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-sm-0'],
        'items' => Yii::$app->params['menus']['top_left'],
        'encodeLabels' => false,
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-right mb-2 mb-sm-0'],
        'items' => Yii::$app->params['menus']['top_right'],
        'encodeLabels' => false,
    ]);
NavBar::end();
?>
<header class="px-0 border-bottom"> 
    <div class="container-fluid px-3">
        <?php
            NavBar::begin([
                // 'brandLabel' => Yii::$app->name,
                'brandLabel' => Html::img(Yii::getAlias('@web/images/logos/Logo-header.png'), ['alt'=>Yii::$app->name, 'height' => '32', 'class' => 'me-2']),
                // 'brandImage' => Yii::getAlias('@web/images/logos/Logo-header.png'),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => ['class' => 'navbar navbar-expand-md bg-body-white rounded'],
                'innerContainerOptions' => ['class' => 'container-fluid'],
                'brandOptions' => ['class' => 'bi me-2'],
            ]);
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav me-auto mb-2 mb-lg-0'],
                    'items' => Yii::$app->params['menus']['top_primary'],
                    'encodeLabels' => false,
                ]);
                
                if (!Yii::$app->user->isGuest) {
                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav me-right mb-2 mb-lg-0'],
                        'items' => [
                            [
                                'label' => '<img src="'.Yii::$app->user->identity->avatarUrl.'" alt="mdo" width="32" height="32" class="rounded-circle"> ' . Yii::$app->user->identity->username,
                                'url' => ['/site/index'],
                                'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
                                'items' => array_merge(Yii::$app->params['menus']['my_account'], [
                                    '<hr class="dropdown-divider">',
                                        Html::beginForm(['/site/logout'])
                                        . Html::submitButton(
                                            'Cerrar sesion',
                                            ['class' => 'dropdown-item']
                                        )
                                        . Html::endForm()
                                ])
                            ],
                            Yii::$app->user->can('admin') ? [
                                'label' => '<i class="bi bi-gear-wide-connected"></i> AdminPanel',
                                'url' => ['/site/index'],
                                // 'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
                                'items' => Yii::$app->params['menus']['admin']
                            ] : '',
                        ],
                        'encodeLabels' => false,
                    ]);
                }
            NavBar::end();
        ?>
    </div>

    <?php 
        NavBar::begin([
            // 'brandLabel' => Yii::$app->name,
            // 'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar navbar-expand-sm navbar-dark bg-dark'],
            'innerContainerOptions' => ['class' => 'container-fluid'],
            'brandOptions' => ['class' => 'bi me-2'],
        ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav me-auto mb-2 mb-sm-0'],
                'items' => Yii::$app->params['menus']['top_secondary'],
                'encodeLabels' => false,
            ]);
            
            if (Yii::$app->user->isGuest) {
                echo '<div class="text-end">';
                    echo '<a href="'.Url::toRoute(['/site/login']).'" class="btn btn-light text-dark me-2">Ingresar</a>';
                    echo '<a href="'.Url::toRoute(['/site/signup']).'" class="btn btn-primary">Registrarte</a>';
                echo '</div>';
            } else {
                // echo '<form role="search">
                //     <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                // </form>';
            }

        NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <div class="bg-light rounded-3 mt-3 pb-1 p-3 mb-2">
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            </div>
        <?php endif ?>
        <?= Alert::widget() ?>
    </div>
    <?= $content ?>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; PACMEC <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?php // = Yii::powered() ?>Powered by FelipheGomez</div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
