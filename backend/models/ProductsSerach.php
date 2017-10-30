<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Products;

/**
 * ProductsSerach represents the model behind the search form of `backend\models\Products`.
 */
class ProductsSerach extends Products
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['ASIN', 'Title', 'Price', 'Picture', 'EAN', 'Brand'], 'safe'],
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
        $query = Products::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'ASIN', $this->ASIN])
            ->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'Price', $this->Price])
            ->andFilterWhere(['like', 'Picture', $this->Picture])
            ->andFilterWhere(['like', 'EAN', $this->EAN])
            ->andFilterWhere(['like', 'Brand', $this->Brand]);

        return $dataProvider;
    }
}
