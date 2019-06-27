<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 01.01.2019
 * Time: 20:30
 */

namespace app\modules\library\controllers;

use app\controllers\AppController;
use app\modules\library\models\MyOrderListSearch;
use yii\db\Expression;
use yii\web\Controller;
use Yii;
use app\modules\library\models\Book;
use app\modules\library\models\Order;

class OrderController extends AppController
{

    public function actionAdd(){
        $this->layout = false;
        $id = Yii::$app->request->get('id');
        $uid = Yii::$app->getuserinfo->getId();
        $book = Book::find()->select(['book_naimen_id'])->where(['book_naimen_id' => $id])->one();
        if(empty($book)) return false;
        $is_ordered = Order::find()->where(['status' => 0])->andWhere(['naimen_id' => $id])->andWhere(['uid' => $uid])->asArray()->one();
        if(!empty($is_ordered)){
            Yii::$app->db2->createCommand("DELETE FROM orders WHERE uid = '$uid' and status = '0' and naimen_id = '$id'")->execute();
        }

        $order = new Order();
        $order->uid = $uid;
        $order->naimen_id = $id;
        $order->order_date = (new Expression('Now()'));
        $order->status = 0;
        $order->SID = Yii::$app->session->getId();
        if($order->save()){
            $user_orders = Order::find()
                ->select(['DISTINCT(bm.book_naimen_id)', 'bm.naimen', 'bm.book_author', 'o.order_date'])
                ->from('orders o')
                ->innerJoin('book_main bm', 'o.naimen_id=bm.book_naimen_id')
                ->where(['status' => 0])
                ->andWhere(['uid' => $uid])
                ->asArray()
                ->all();
            return $this->render('order-modal', compact('user_orders'));
        }else{
            return Yii::t('book','This Book not found from Databse! Book_Naimen_');
        }

    }

    public function actionClearOrders(){
        $this->layout = false;
        $uid = Yii::$app->getuserinfo->getId();
        Yii::$app->db2->createCommand("DELETE FROM orders WHERE uid = '$uid' and status = 0")->execute();
        $user_orders = Order::find()
            ->select(['bm.naimen', 'bm.book_author', 'o.order_date'])
            ->from('orders o')
            ->innerJoin('book_main bm', 'o.naimen_id=bm.book_naimen_id')
            ->where(['status' => 0])
            ->andWhere(['uid' => $uid])
            ->asArray()
            ->all();
        return $this->render('order-modal', compact('user_orders'));
    }
    public function actionDelItem(){
        $id = Yii::$app->request->get('id');
        $uid = Yii::$app->getuserinfo->getId();
        $query = Yii::$app->db2->createCommand("DELETE FROM orders WHERE uid = '$uid' AND status=0 AND naimen_id = '$id'");
        if(!$query->execute()){
            return false;
        }
        $this->layout = false;
        $user_orders = Order::find()
            ->select(['DISTINCT(bm.book_naimen_id)', 'bm.naimen', 'bm.book_author', 'o.order_date'])
            ->from('orders o')
            ->innerJoin('book_main bm', 'o.naimen_id=bm.book_naimen_id')
            ->where(['status' => 0])
            ->andWhere(['uid' => $uid])->groupBy('bm.book_naimen_id')
            ->asArray()
            ->all();
        return $this->render('order-modal', compact('user_orders'));
    }

    public function actionShow(){
        $uid = Yii::$app->getuserinfo->getId();
        $this->layout = false;
        $user_orders = Order::find()
            ->select(['DISTINCT(bm.book_naimen_id)', 'bm.naimen', 'bm.book_author', 'o.order_date'])
            ->from('orders o')
            ->innerJoin('book_main bm', 'o.naimen_id=bm.book_naimen_id')
            ->where(['status' => 0])
            ->andWhere(['uid' => $uid])->groupBy('bm.naimen')
            ->asArray()
            ->all();
        return $this->render('order-modal', compact('user_orders'));
    }

    public function actionAddFromModal(){
        $this->layout = false;
        $id = Yii::$app->request->get('id');
        $uid = Yii::$app->getuserinfo->getId();
        $book = Book::find()->select(['book_naimen_id'])->where(['book_naimen_id' => $id])->one();
        if(empty($book)) return false;
        $is_ordered = Order::find()->where(['status' => 0])->andWhere(['naimen_id' => $id])->andWhere(['uid' => $uid])->asArray()->one();
        if(!empty($is_ordered)){
            Yii::$app->db2->createCommand("DELETE FROM orders WHERE uid = '$uid' and status = '0' and naimen_id = '$id'")->execute();
        }
        $order = new Order();
        $order->uid = $uid;
        $order->naimen_id = $id;
        $order->order_date = (new Expression('Now()'));
        $order->status = 0;
        $order->SID = Yii::$app->session->getId();
        if($order->save()){
            $this->redirect('/library/book/list-books-sidebar');
        }else{
            return Yii::t('book','This Book not found from Databse! Book_Naimen_');
        }

    }

    public function actionMyOrderList(){
        if(Yii::$app->user->isGuest){
            return $this->redirect('/');
        }

        $searchModel = new MyOrderListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('my-order-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDelOrderItem(){

    }

    public function actionDelete($id)
    {
        $uid = Yii::$app->getuserinfo->getId();
        $query = Yii::$app->db2->createCommand("DELETE FROM orders WHERE uid = '$uid' AND status=0 AND naimen_id = '$id'");
        if(!$query->execute()){
            return false;
        }
        $user_orders = Order::find()
            ->select(['DISTINCT(bm.book_naimen_id)', 'bm.naimen', 'bm.book_author', 'o.order_date', 'o.status'])
            ->from('orders o')
            ->innerJoin('book_main bm', 'o.naimen_id=bm.book_naimen_id')
            ->andWhere(['uid' => $uid])->groupBy('bm.book_naimen_id')->orderBy('o.status')
            ->asArray()
            ->all();
        //return $this->render('my-order-list', compact('user_orders'));

        return $this->redirect(['my-order-list']);
    }
}