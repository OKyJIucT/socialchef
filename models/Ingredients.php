<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingredients".
 *
 * @property integer $id
 * @property string $name
 * @property string $category
 * @property string $category_ru
 * @property string $pcs
 * @property string $tea
 * @property string $stol
 * @property string $stakan
 * @property string $calories
 * @property string $belok
 * @property string $zhir
 * @property string $uglevod
 * @property string $image
 * @property integer $created_at
 * @property integer $updated_at
 */
class Ingredients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingredients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category', 'category_ru', 'image'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'category', 'category_ru', 'pcs', 'tea', 'stol', 'stakan', 'calories', 'belok', 'zhir', 'uglevod', 'image'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'category' => 'Категория (лат.)',
            'category_ru' => 'Категория',
            'pcs' => 'Вес единицы',
            'tea' => 'Вес чайной ложки',
            'stol' => 'Вес столовой ложки',
            'stakan' => 'Вес стакана',
            'calories' => 'Калорий в 100 г',
            'belok' => 'Белка в 100 г',
            'zhir' => 'жиров в 100 г',
            'uglevod' => 'Углеводов в 100 г',
            'image' => 'Изображение',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }
}
