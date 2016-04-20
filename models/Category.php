<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Post[] $posts
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 128],
        ];
    }

    /**
     * Поведения
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'slug' => [
                'class' => 'app\components\SlugBehavior',
                'in_attribute' => 'title',
                'out_attribute' => 'slug'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название категории',
            'slug' => 'Альтернативное название (лат.)',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['category_id' => 'id'])->inverseOf('category');
    }
}
