<?php
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\BootstrapAsset;
use yii\web\ForbiddenHttpException;

/* @var $this \yii\web\View */
/* @var $content string */

$user = Yii::$app->getUser();

if (\Yii::$app->controller->module->id == 'permit' || \Yii::$app->controller->module->id == 'admin') {

    if (!$user->can('admin')) {
        throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
    }

    BootstrapAsset::register($this);
}

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="<?= Yii::$app->charset ?>">
            <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

            <?= Html::csrfMetaTags() ?>
            <title><?= Html::encode($this->title) ?></title>

            <?php $this->head() ?>

            <link rel="shortcut icon" href="images/favicon.ico"/>

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// --><!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script><![endif]-->
        </head>
        <body class="home">
            <?php $this->beginBody() ?>
            <!--header-->
            <header class="head" role="banner">
                <!--wrap-->
                <div class="wrap clearfix">
                    <a href="/" title="SocialChef" class="logo"><img src="/images/ico/logo.png"
                                                                     alt="SocialChef logo"/></a>
                    <nav class="main-nav" role="navigation" id="menu">
                        <?php
                        echo Menu::widget([
                            'options' => [],
                            'items' => [
                                ['label' => 'Главная', 'url' => ['/site/index']],
                                ['label' => 'Админка',
                                    'items' => [
                                        ['label' => 'Категории', 'url' => ['/admin/category/index'], 'active' => \Yii::$app->controller->module->id == 'admin'],
                                        ['label' => 'Посты', 'url' => ['/admin/post/index'], 'active' => \Yii::$app->controller->module->id == 'admin'],
                                    ],
                                    'url' => 'javascript: void();',
                                    'visible' => $user->can('admin'),
                                    'active' => \Yii::$app->controller->module->id == 'admin'
                                ],
                                ['label' => 'Права доступа',
                                    'items' => [
                                        ['label' => 'Роли', 'url' => ['/permit/access/role'], 'active' => \Yii::$app->controller->module->id == 'permit'],
                                        ['label' => 'Разрешения', 'url' => ['/permit/access/permission'], 'active' => \Yii::$app->controller->module->id == 'permit'],
                                    ],
                                    'url' => 'javascript: void();',
                                    'visible' => $user->can('admin'),
                                    'active' => \Yii::$app->controller->module->id == 'permit'
                                ],
                                Yii::$app->user->isGuest ? ['label' => 'Регистрация', 'url' => ['/site/reg']] : '',
                                Yii::$app->user->isGuest ? ['label' => 'Вход', 'url' => ['/site/login']] : ['label' => 'Выход (' . Yii::$app->user->identity->username . ')', 'url' => ['/site/logout']],
                            ],
                            'linkTemplate' => '<a href="{url}"><span>{label}</span></a>',
                            'activeCssClass' => 'current-menu-item'
                        ]);
                        ?>
                    </nav>

                    <nav class="user-nav" role="navigation">
                        <ul>
                            <li class="light"><a href="find_recipe.html" title="Search for recipes"><i
                                        class="ico i-search"></i> <span>Search for recipes</span></a></li>
                            <li class="medium"><a href="/login" title="My account"><i
                                        class="ico i-account"></i> <span>My account</span></a></li>
                            <li class="dark"><a href="submit_recipe.html" title="Submit a recipe"><i
                                        class="ico i-submitrecipe"></i> <span>Submit a recipe</span></a></li>
                        </ul>
                    </nav>
                </div>
                <!--//wrap-->
            </header>
            <!--//header-->

            <!--main-->
            <main class="main" role="main">
                <div class="wrap clearfix">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= $content ?>
                </div>

                <a href="#0" class="cd-top">Top</a>
            </main>
            <!--//main-->

            <!--call to action-->
            <section class="cta">
                <div class="wrap clearfix">
                    <a href="login.html" class="button big white right">Purchase theme</a>

                    <h2>Already convinced? This is a call to action section lorem ipsum dolor sit amet.</h2>
                </div>
            </section>
            <!--//call to action-->

            <!--footer-->
            <footer class="foot" role="contentinfo">
                <div class="wrap clearfix">
                    <div class="row">
                        <article class="one-half">
                            <h5>About SocialChef Community</h5>

                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci.</p>
                        </article>
                        <article class="one-fourth">
                            <h5>Need help?</h5>

                            <p>Contact us via phone or email</p>

                            <p><em>T:</em> +1 555 555 555<br/><em>E:</em> <a href="#">socialchef@email.com</a></p>
                        </article>
                        <article class="one-fourth">
                            <h5>Follow us</h5>
                            <ul class="social">
                                <li class="facebook"><a href="#" title="facebook">facebook</a></li>
                                <li class="youtube"><a href="#" title="youtube">youtube</a></li>
                                <li class="rss"><a href="#" title="rss">rss</a></li>
                                <li class="gplus"><a href="#" title="gplus">google plus</a></li>
                                <li class="linkedin"><a href="#" title="linkedin">linkedin</a></li>
                                <li class="twitter"><a href="#" title="twitter">twitter</a></li>
                                <li class="pinterest"><a href="#" title="pinterest">pinterest</a></li>
                                <li class="vimeo"><a href="#" title="vimeo">vimeo</a></li>
                            </ul>
                        </article>

                        <div class="bottom">
                            <p class="copy">Copyright 2014 SocialChef. All rights reserved</p>

                            <nav class="foot-nav">
                                <ul>
                                    <li><a href="index-2.html" title="Home">Home</a></li>
                                    <li><a href="recipes.html" title="Recipes">Recipes</a></li>
                                    <li><a href="blog.html" title="Blog">Blog</a></li>
                                    <li><a href="contact.html" title="Contact">Contact</a></li>
                                    <li><a href="find_recipe.html" title="Search for recipes">Search for recipes</a>
                                    </li>
                                    <li><a href="login.html" title="Login">Login</a></li>
                                    <li><a href="register.html" title="Register">Register</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </footer>
            <!--//footer-->


            <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
            <?php $this->endBody() ?>
        </body>
    </html>
<?php $this->endPage() ?>