<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\RegForm;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\components\Y;
use app\components\Rbac;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'login', 'logout', 'reg'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'login', 'logout', 'reg']
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        $dir = date("/Y/m/d/");

        return [
            'error' => ['class' => 'yii\web\ErrorAction'],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => '/static/images/posts' . $dir, // Directory URL address, where files are stored.
                'path' => '@webroot/static/images/posts' . $dir, // Or absolute path to directory where files are stored.
                'type' => '\vova07\imperavi\actions\GetAction::TYPE_IMAGES',
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => '/static/images/posts' . $dir, // Directory URL address, where files are stored.
                'path' => '@webroot/static/images/posts' . $dir // Or absolute path to directory where files are stored.
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                // form inputs are valid, do something here
                return $this->goBack();
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionReg()
    {
        $model = new RegForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($user = $model->reg()) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                } else {
                    Yii::$app->session->setFlash('danger', 'Возникла ошибка при регистрации.');
                    Yii::error('Ошибка при регистрации');

                    return $this->refresh();
                }

            }
        }

        return $this->render('reg', [
            'model' => $model,
        ]);
    }


    public function actionRbac()
    {
        if (Y::isAuthenticated()) {

            $user = Rbac::createRole('user', 'Пользователь');
            $admin = Rbac::createRole('admin', 'Админ');

            $viewPost = Rbac::createPermission('viewPost');

            Rbac::addChild($user, $viewPost);
            Rbac::addChild($admin, $user);

            // назначаем текущего юзера админом
            Rbac::assign('admin', 1);
        }
    }
}
