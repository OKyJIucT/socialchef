<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\RegForm;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\components\Y;
use app\components\Rbac;

class RbacController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = Rbac::createRole('user', 'Пользователь');
        $admin = Rbac::createRole('admin', 'Админ');

        $viewPost = Rbac::createPermission('viewPost'); // просмотр новости

        $createPost = Rbac::createPermission('createPost'); // создание новости
        $updatePost = Rbac::createPermission('updatePost'); // редактирование новости
        $deletePost = Rbac::createPermission('deletePost'); // удаление новости

        Rbac::addChild($user, $viewPost);

        Rbac::addChild($admin, $user);
        Rbac::addChild($admin, $createPost);
        Rbac::addChild($admin, $updatePost);
        Rbac::addChild($admin, $deletePost);

        // назначаем текущего юзера админом
        Rbac::assign('admin', 1);
    }
}
