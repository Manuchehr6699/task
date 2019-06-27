<?php

namespace app\modules\library\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\library\models\Book;

/**
 * BookSearch represents the model behind the search form of `app\modules\library\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['flagIzmen', 'flagIzYak', 'flagIzAgro', 'doc_id', 'naimen', 'book_author', 'format', 'ISBN', 'BBK', 'UDK', 'photo', 'describe', 'cd', 'floppy', 'created_at', 'updated_at'], 'safe'],
            [['doc_num', 'doc_year', 'book_id_start', 'book_naimen_id', 'lot_id', 'book_count', 'izdan', 'soli_nashr', 'nashriyot_id', 'joi_nashr_id', 'count_page', 'book_language_id', 'cover_id', 'cat_id', 'seriya_id', 'stilaz', 'polka', 'is_block', 'created_by', 'updated_by'], 'integer'],
            [['price_now', 'price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Book::find();

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
            'doc_num' => $this->doc_num,
            'doc_year' => $this->doc_year,
            'book_id_start' => $this->book_id_start,
            'book_naimen_id' => $this->book_naimen_id,
            'lot_id' => $this->lot_id,
            'book_count' => $this->book_count,
            'izdan' => $this->izdan,
            'soli_nashr' => $this->soli_nashr,
            'nashriyot_id' => $this->nashriyot_id,
            'joi_nashr_id' => $this->joi_nashr_id,
            'count_page' => $this->count_page,
            'book_language_id' => $this->book_language_id,
            'price_now' => $this->price_now,
            'price' => $this->price,
            'cover_id' => $this->cover_id,
            'cat_id' => $this->cat_id,
            'seriya_id' => $this->seriya_id,
            'stilaz' => $this->stilaz,
            'polka' => $this->polka,
            'is_block' => $this->is_block,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'flagIzmen', $this->flagIzmen])
            ->andFilterWhere(['like', 'flagIzYak', $this->flagIzYak])
            ->andFilterWhere(['like', 'flagIzAgro', $this->flagIzAgro])
            ->andFilterWhere(['like', 'doc_id', $this->doc_id])
            ->andFilterWhere(['like', 'naimen', $this->naimen])
            ->andFilterWhere(['like', 'book_author', $this->book_author])
            ->andFilterWhere(['like', 'format', $this->format])
            ->andFilterWhere(['like', 'ISBN', $this->ISBN])
            ->andFilterWhere(['like', 'BBK', $this->BBK])
            ->andFilterWhere(['like', 'UDK', $this->UDK])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'describe', $this->describe])
            ->andFilterWhere(['like', 'cd', $this->cd])
            ->andFilterWhere(['like', 'floppy', $this->floppy]);

        return $dataProvider;
    }
}
