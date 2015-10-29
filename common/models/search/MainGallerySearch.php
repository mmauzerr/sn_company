<?php
/**
 * Created by PhpStorm.
 * User: Milos Barlov <mbarlov> milosbarlov@gmail.com
 * Date: 15.7.15. \
 * Time: 19.52
 */

namespace common\models\search;


use common\models\MainGallery;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class MainGallerySearch extends MainGallery
{
    public function rules()
    {
        return [
            [['id', 'parent_id', 'created_by', 'create_time', 'updated_by', 'update_time', 'status', 'type'], 'integer'],
            [['title', 'excerpt', 'content'], 'safe'],
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
        $query = MainGallery::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $query->andWhere(['type'=>1]);

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'created_by' => $this->created_by,
            'create_time' => $this->create_time,
            'updated_by' => $this->updated_by,
            'update_time' => $this->update_time,
            'status' => $this->status,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'excerpt', $this->excerpt])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }

}