<?php
/**
 * Created by PhpStorm.
 * User: kohone
 * Date: 17.10.2015
 * Time: 12:06
 */

namespace app\components;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;
use dosamigos\transliterator\TransliteratorHelper;

class SlugBehavior extends Behavior
{
    public $in_attribute = 'title';
    public $out_attribute = 'slug';
    public $translit = true;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'getSlug'
        ];
    }

    public function getSlug()
    {
        $this->owner->{$this->out_attribute} = $this->owner->{$this->in_attribute}
            ? Inflector::slug(TransliteratorHelper::process($this->owner->{$this->in_attribute}), '-', true)
            : $this->owner->{$this->in_attribute};
    }

}