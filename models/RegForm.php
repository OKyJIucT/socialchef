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
use app\models\ReCaptchaValidator;
use app\components\Rbac;

class RegForm extends Model
{
    public $username;
    public $email;
    public $password;

    public $reCaptcha;

    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'filter', 'filter' => 'trim'],
            [['username', 'email', 'password'], 'required'],
            ['username', 'string', 'min' => 5, 'max' => 255],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['username', 'unique',
                'targetClass' => Users::className(),
                'message' => 'Это имя уже занято.'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => Users::className(),
                'message' => 'Эта почта уже занята.'],
            [['reCaptcha'], ReCaptchaValidator::className(), 'message' => 'Вы робот?', 'secret' => '6LfkVAsTAAAAAB7_So7CeohfI00dbJymtfo2Rx_V']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'email' => 'Электронная почта',
            'password' => 'Пароль'
        ];
    }

    public function reg()
    {
        $user = new Users();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if($user->save()) {

            // добавляем юзеру роль user
            Rbac::assign('user', $user->id);

            return $user;
        }

        return null;

    }


}