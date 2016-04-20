<?php
/**
 * Created by PhpStorm.
 * User: kohone
 * Date: 09.08.2015
 * Time: 19:26
 */

namespace app\components;

use yii\helpers\VarDumper;
use Yii;

use dosamigos\transliterator\TransliteratorHelper;
use yii\helpers\Inflector;

class Y {
    /**
     * Ярлык для функции dump класса VarDumper для отладки приложения
     * @param mixed $data Переменная для вывода
     * @param depth - глубина дампа переменной
     * @param highlight - подсветка синтаксиса
     */
    public static function dump($data, $end = false, $depth = 10, $highlight = true) {
        VarDumper::dump($data, $depth, $highlight);

        if ($end)
            Yii::$app->end();

    }

    public static function alert($name) {
        if ($msg = Yii::$app->session->getFlash($name)) {
            echo '
                <div class="alert alert-' . $name . ' alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <p>' . $msg . '
                    </p>
                </div>';
        }
    }

    /**
     * @return CWebUser
     */
    public static function user() {
        return Yii::$app->getUser();
    }

    /**
     * Returns true if the user is authenticated, otherwise - false
     *
     * @return boolean
     */
    public static function isAuthenticated() {
        return !Yii::$app->user->getIsGuest();
    }

    /**
     * Returns true if the user is a guest (not authenticated), otherwise - false
     *
     * @return boolean
     */
    public static function isGuest() {
        return Yii::$app->user->getIsGuest();
    }


    public static function userId() {
        return Yii::$app->user->identity->id ? Yii::$app->user->identity->id : false;
    }


    /**
     * Получаем текущий экшен
     * @return mixed
     */
    public static function thisAction() {
        return Yii::$app->controller->action->id;
    }


    /**
     * Получаем текущий модуль
     * @return mixed
     */
    public static function thisModule() {
        return Yii::$app->controller->module->id;
    }


    /**
     * Получаем хеш
     *
     * @param $data
     * @return string
     */
    public static function getHash($data = null) {
        if ($data) return md5(strrev(md5($data)));

        return md5(strrev(md5(time() . rand(100, 9999999))));
    }


    /**
     * @param $key
     * @param $data
     * @param int $duration
     * Устанавливаем кеш
     */
    public static function setCache($key, $data, $duration = 3600) {
        $key = $key . md5(dirname(__DIR__));
        $cache = Yii::$app->cache;
        $cache->set($key, $data, $duration);
    }


    /**
     * @param $key
     * @return mixed
     * Читаем кеш
     */
    public static function getCache($key) {
        $key = $key . md5(dirname(__DIR__));

        $cache = Yii::$app->cache;
        $data = $cache->get($key);

        return $data;
    }


    /**
     * @param $key
     * Удаляем кеш по ключу
     */
    public static function deleteCache($key) {
        $key = $key . md5(dirname(__DIR__));

        $cache = Yii::$app->cache;
        $cache->delete($key);
    }


    /**
     * Удаляем весь кеш
     */
    public static function flushCache() {
        $cache = Yii::$app->cache;
        $cache->flush();
    }


    public static function slug($text)
    {
        return Inflector::slug(TransliteratorHelper::process($text), '-', true);
    }


    /**
     * Обрезаем строку
     *
     * @param $string
     * @param int $length
     * @return string
     */
    public static function cut($string, $length = 400)
    {
        if (mb_strlen($string) < $length)
            return $string;
        $string = strip_tags($string);
        $string = mb_substr($string, 0, $length);
        $string = rtrim($string, "!,.-");
        $string = mb_substr($string, 0, strrpos($string, ' '));

        return $string . "...";
    }


    /**
     * @param $num
     * @param $p1
     * @param $p2
     * @param $p5
     * @return mixed
     * Падежи времен
     */
    public static function padezh($num, $p1, $p2, $p5)
    {
        $x = $num % 100;
        $y = ($x % 10) - 1;
        $res = ($x / 10) >> 0 == 1 ? $p5 : ($y & 12 ? $p5 : ($y & 3 ? $p2 : $p1));

        return $res;
    }

    /**
     * @param $sd
     * @param null $snow
     * @return bool|string
     * Фукнкция по работе со временем. "5 минут назад"
     */
    public static function dateDiff($sd, $snow = null)
    {
        if ($snow === null) $snow = time();
        $seconds = $snow - $sd;
        $aseconds = abs($seconds);
        if ($aseconds < 120) {
            return ("Только что");
        } elseif ($aseconds < 3600) {
            return ($seconds < 0 ? "через " : "") . (round($aseconds / 60) % 60) . " " . Y::padezh(round($aseconds / 60) % 60, "минуту", "минуты", "минут") . ($seconds > 0 ? " назад" : "");
        } elseif ($aseconds < 18000) {
            return ($seconds < 0 ? "через " : "") . (round($aseconds / 3600) % 24) . " " . Y::padezh(round($aseconds / 3600) % 24, "час", "часа", "часов") . ($seconds > 0 ? " назад" : "");
        } elseif (($days = abs(strtotime(date("Y-m-d", $sd)) - strtotime(date("Y-m-d", $snow))) / 3600 / 24 >> 0) < 3) {
            if ($seconds >= 0) {
                switch ($days) {
                    case 0:
                        return "сегодня в " . date("H:i", $sd);
                        break;
                    case 1:
                        return "вчера в " . date("H:i", $sd);
                        break;
                    case 2:
                        return "позавчера в " . date("H:i", $sd);
                        break;
                }
            } else {
                switch ($days) {
                    case 0:
                        return "сегодня в " . date("H:i", $sd);
                        break;
                    case 1:
                        return "завтра в " . date("H:i", $sd);
                        break;
                    case 2:
                        return "послезавтра в " . date("H:i", $sd);
                        break;
                }
            }
        } else {
            return date("d.m.Y в H:i", $sd);
        }
    }


    /**
     * @param $slug
     * @return mixed
     * Конвертируем URL в айди и slug
     */
    public static function convertSlug($slug)
    {
        $tmp = explode("-", $slug);
        if (sizeof($tmp) < 2) return null;

        $result['slug_id'] = $tmp[0];
        unset($tmp[0]);
        $result['slug_value'] = implode("-", $tmp);

        return $result;
    }



    /**
     * @param $array
     * публикуем метатеги
     */
    public static function metaTags($array)
    {
        Yii::$app->view->registerMetaTag($array);
    }
    
    

}