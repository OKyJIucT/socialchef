<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use developeruz\db_rbac\interfaces\UserRbacInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property integer $created_at
 * @property integer $updated_at
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface, UserRbacInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'username', 'password'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['email', 'username'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 128],
            [['auth_key'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    /**
     * Поведения
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }


    /**
     * Поиск пользователя
     */
    public static function findByUsername($username)
    {
        return static::findOne(
            [
                'username' => $username
            ]
        );
    }


    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getUserName()
    {
        return $this->username;
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /* Хелперы */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id'])->inverseOf('user');
    }
}
