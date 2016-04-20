<?php
/**
 * Created by PhpStorm.
 * User: ё
 * Date: 10.04.2016
 * Time: 15:51
 */

namespace app\components;

use yii\helpers\VarDumper;
use Yii;
use app\components\Y;

class Rbac
{

    private function getAuth()
    {
        return Yii::$app->authManager;
    }


    /**
     * Возвращает найденную роль, добавив ее, если отсутствует
     *
     * $user = Rbac::createRole('user', 'Пользователь');
     *
     * @param $role
     * @param bool $comment
     * @return null|\yii\rbac\Role
     */
    public static function createRole($role, $description = false)
    {
        $auth = self::getAuth();

        // добавляем роль "$role", если ее нет
        $addRole = $auth->getRole($role);
        if (!$addRole) {
            $addRole = $auth->createRole($role);
            $addRole->description = $description ? $description : $role;
            $auth->add($addRole);
        }

        return $addRole;
    }


    /**
     * Возвращает найденное разрешение, добавив его, если отсутствует
     *
     * $viewPost = Rbac::createPermission('viewPost');
     *
     * @param $permission
     * @param bool $description
     * @return null|\yii\rbac\Permission
     */
    public static function createPermission($permission, $description = false)
    {
        $auth = self::getAuth();

        // добавляем разрешение "$permission", если его нет
        $addPermission = $auth->getPermission($permission);
        if (!$addPermission) {
            $addPermission = $auth->createPermission($permission);
            $addPermission->description = $description ? $description : $permission;
            $auth->add($addPermission);
        }

        return $addPermission;
    }


    /**
     * Присваивает элементу $parent дочернее разрешение $child, либо берем их из другой роли $child
     *
     * Rbac::addChild($user, $viewPost); // присвоили роли разрешение
     * Rbac::addChild($admin, $user); // присвоили роли разрешения другой роли
     *
     * @param $parent
     * @param $child
     * @return bool
     */
    public static function addChild($parent, $child)
    {
        $auth = self::getAuth();

        // добавляем разрешение "$permission", если его нет
        $addChild = $auth->hasChild($parent, $child);
        if (!$addChild) {
            $auth->addChild($parent, $child);
        }
    }
    

    /**
     * Добавляет к пользователю роль, если она не существует
     * 
     * Rbac::assign('admin', 1);
     * 
     * @param $roleName
     * @param $user_id
     */
    public static function assign($roleName, $user_id)
    {
        $auth = self::getAuth();

        $role = $auth->getRole($roleName);

        $assign = $auth->getAssignment($roleName, $user_id);
        if (!$assign) {
            $auth->assign($role, $user_id);
        }

    }


    /**
     * Проверка прав доступа
     * @param $permission
     * @return bool
     */
    public static function can($permission)
    {
        if (Yii::$app->user->can($permission)) {
            return true;
        }

        return false;
    }
}