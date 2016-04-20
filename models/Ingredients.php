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
            'name' => 'Name',
            'category' => 'Category',
            'category_ru' => 'Category Ru',
            'pcs' => 'Pcs',
            'tea' => 'Tea',
            'stol' => 'Stol',
            'stakan' => 'Stakan',
            'calories' => 'Calories',
            'belok' => 'Belok',
            'zhir' => 'Zhir',
            'uglevod' => 'Uglevod',
            'image' => 'Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
