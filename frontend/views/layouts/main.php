<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use host33\multilevelhorizontalmenu\MultilevelHorizontalMenu;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= $this->title ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#ffffff">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode(Yii::$app->name) ?></title>
        <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Yii::$app->request->baseUrl . 'images/logo1.png']); ?>
        <?php $this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '76x76', 'href' => Yii::$app->request->baseUrl . 'images/apple-touch-icon.png']); ?>
        <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '32x32', 'href' => Yii::$app->request->baseUrl . 'images/favicon-32x32.png']); ?>  
        <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '16x16', 'href' => Yii::$app->request->baseUrl . 'images/favicon-16x16.png']); ?>  
        <?php $this->registerLinkTag(['rel' => 'manifest', 'href' => Yii::$app->request->baseUrl . 'images/manifest.json']); ?>  
        <?php $this->registerLinkTag(['rel' => 'mask-icon', 'href' => Yii::$app->request->baseUrl . 'images/safari-pinned-tab.svg', 'color' => '#5bbad5']); ?>  




        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Html::img('@web/images/logo1.png', ['alt' => Yii::$app->name, 'class' => 'img-responsive pull-left']) . "<p class='site-title'>" . Yii::$app->name . "</p>",
                'brandUrl' => Yii::$app->homeUrl,
                'brandOptions' => [],
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);

            /* if (Yii::$app->user->isGuest) {
              $menuItems[] = ['label' => 'Signup', 'url' => ['site/signup']];
              $menuItems[] = ['label' => 'Login', 'url' => ['site/login']];
              } else {
              $menuItems[] = '<li>'
              . Html::beginForm(['/site/logout'], 'post')
              . Html::submitButton(
              'Logout (' . Yii::$app->user->identity->username . ')',
              ['class' => 'btn btn-link logout']
              )
              . Html::endForm()
              . '</li>';
              } */

           /* $menuItems = [
                'menu' => [
                        ['label' => 'Home', 'url' => ['route' => 'site/index']],
                        ['url' => [], "label" => 'Printing',
                            ["url" => ['route' => 'printing/lage-format'], 'label' => 'Lage format Printing',],
                            ["url" => ['route' => 'printing/t-shirt'], 'label' => 'T-shirt Printing',],
                            ["url" => ['route' => 'printing/digital'], 'label' => 'Digital Printing',]
                    ],
                        ['url' => [], "label" => 'Photography',
                            ["url" => ['route' => 'photography/events'], 'label' => 'Events Photography',],
                            ["url" => ['route' => 'photography/products'], 'label' => 'Products Photography',],
                            ["url" => ['route' => 'photography/fashion'], 'label' => 'Fashion Photography',],
                            ["url" => ['route' => 'photography/model_portfolio'], 'label' => 'Model Portfolio',],
                    ],
                        ['label' => 'Technology', 'url' => ['route' => 'site/technology']],
                        ['label' => 'About us', 'url' => ['route' => 'site/about']],
                ]
            ];*/
            
            $menuItems = [
                    [
                    'label' => 'Home',
                    'url' => ['site/index'],
                ],
                    [
                    'label' => 'Printing',
                    'items' => [
                            ['label' => 'Lage format Printing', 'url' => ['printing/largeformat']],
                            ['label' => 'T-shirt Printing', 'url' => '#'],
                            ['label' => 'Digital Printing', 'url' => '#'],
                    ],
                ],
                    [
                    'label' => 'Photography',
                    'items' => [
                            ['label' => 'Events Photography', 'url' => '#'],
                            ['label' => 'Products Photography', 'url' => '#'],
                            ['label' => 'Model Portfolio', 'url' => '#'],
                            ['label' => 'Fashion Photography', 'url' => '#'],
                    ],
                ],
                 [
                    'label' => 'Technology',
                    'url' => ['#'],
                ],
                 [
                    'label' => 'About us',
                    'url' => ['site/about'],
                ],
                [
                    'label' => 'Contact Us',
                    'url' => ['site/contact'],
                ],
            ];


            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);


            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy;<?= Yii::$app->name ?> <?= date('Y') ?></p>

                <p class="pull-right"> Powered by <a href="http://novatechsolutions.pro">Novatech Consolidated Solutions</a> </p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
