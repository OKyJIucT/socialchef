<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\components\Y;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_text
 * @property string $full_text
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $image
 * @property string $slug
 *
 * @property Users $user
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'short_text', 'full_text', 'user_id', 'category_id', 'slug', 'active'], 'required'],
            [['short_text', 'full_text'], 'string'],
            [['user_id', 'category_id', 'created_at', 'updated_at', 'active'], 'integer'],
            [['title', 'image', 'slug'], 'string', 'max' => 128],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'title' => 'Заголовок',
            'short_text' => 'Краткий текст',
            'full_text' => 'Полный текст',
            'slug' => 'Альтернативное название (лат.)',
            'user_id' => 'Автор поста',
            'username' => 'Автор поста',
            'category_id' => 'Категория',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'image' => 'Основное изображение',
            'active' => 'Опубликовать рецепт?',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id'])->inverseOf('posts');
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id'])->inverseOf('posts');
    }
}
