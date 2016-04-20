<?php
/**
 * Created by PhpStorm.
 * User: kohone
 * Date: 09.08.2015
 * Time: 19:06
 */

namespace app\models;

use yii\base\Model;
use Yii;
use app\components\Y;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $rememberMe = true;

    private $_user = false;

    public function rules()
    {
        return [
            [['username', 'password'], 'filter', 'filter' => 'trim'],
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня'
        ];
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверный логин или пароль');
            }
        }
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Users::findByUsername($this->username);
        }

        return $this->_user;
    }

    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();

            return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }
}