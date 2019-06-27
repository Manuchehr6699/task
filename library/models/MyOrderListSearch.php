<?php

namespace app\modules\library\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\library\models\Order;
use Yii;
/**
 * BookSearch represents the model behind the search form of `app\modules\library\models\Book`.
 */
class MyOrderListSearch extends Order
{
    public $naimen;
    public $book_author;
    public $book_naimen_id;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'naimen_id'], 'required'],
            [['uid', 'naimen_id', 'book_id', 'confirm_by', 'status'], 'integer'],
            [['order_date', 'confirm_date', 'SID', 'naimen', 'book_author'], 'safe'],
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
        $query = Order::find()
            ->select(['DISTINCT(bm.book_naimen_id)', 'bm.naimen', 'bm.book_author', 'o.order_date', 'o.status'])
            ->from('orders o')
            ->innerJoin('book_main bm', 'o.naimen_id=bm.book_naimen_id')
            ->andWhere(['uid' => Yii::$app->getuserinfo->getId()])->groupBy('bm.book_naimen_id')->orderBy('o.status');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {

            return $dataProvider;
        }

        $query->andFilterWhere([
            'order_id' => $this->order_id,
            'uid' => $this->uid,
            'o.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'o.order_date', $this->order_date])
            ->andFilterWhere(['like', 'bm.naimen', $this->naimen])
            ->andFilterWhere(['like', 'bm.book_author', $this->book_author]);

        return $dataProvider;
    }
}
