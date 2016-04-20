<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

/**
 * PostSearch represents the model behind the search form about `app\models\Post`.
 */
class PostSearch extends Post
{
    public $username;
    public $category;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'category_id', 'created_at', 'updated_at'], 'integer'],
            [['username', 'category'], 'string', 'max' => 32],
            [['slug'], 'string', 'max' => 128],
            [['title', 'short_text', 'full_text', 'slug', 'username', 'category'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();

        $query->joinWith(['user', 'category']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['username'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['users.username' => SORT_ASC],
            'desc' => ['users.username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['category'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['category.title' => SORT_ASC],
            'desc' => ['category.title' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
        ]);

        $query->andFilterWhere(['like', 'users.username', $this->username]);
        $query->andFilterWhere(['like', 'category.title', $this->category]);

        return $dataProvider;
    }
}
