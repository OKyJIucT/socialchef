<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

use app\components\Y;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {

        return $this->render('index',
            ['title' => 'Заготовки будущей админки']
        );
    }
}
