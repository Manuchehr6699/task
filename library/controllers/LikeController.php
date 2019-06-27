<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 02.01.2019
 * Time: 12:12
 */

namespace app\modules\library\controllers;

use app\controllers\AppController;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use app\modules\library\models\LikeBook;
use app\modules\library\models\Book;
use yii\db\Expression;


class LikeController extends AppController
{
    public function actionAddLike(){
        $this->layout = false;
        $id = Yii::$app->request->get('id');
        $uid = Yii::$app->getuserinfo->getId();
        $book = Book::find()->select(['book_naimen_id'])->where(['book_naimen_id' => $id])->one();
        if(empty($book)) return false;
        $is_liked = LikeBook::find()
            ->where(['user_id' => $uid])
            ->andWhere(['book_naimen_id' => $id])
            ->andWhere(['book_type' => 'O'])->asArray()->one();
        if(!empty($is_liked)){
            Yii::$app->db->createCommand("DELETE FROM liked_books WHERE book_naimen_id = '$id' AND user_id = '$uid' AND status = 1 AND book_type='O'")
                ->execute();
            $count_like = LikeBook::find()->where(['book_type' => 'O'])->andWhere(['book_naimen_id' => $id])->andWhere(['status' => 1])->count();
            $data = (object)array(
                'res_code' => 2,
                'like_count' => $count_like
            );
            return json_encode($data);
        }
        $like = new LikeBook();
        $like->user_id = $uid;
        $like->book_naimen_id = $id;
        $like->created_at = (new Expression('Now()'));
        $like->status = 1;
        $like->book_type = 'O';
        if($like->save()){
            $count_like = LikeBook::find()->where(['book_type' => 'O'])->andWhere(['book_naimen_id' => $id])->andWhere(['status' => 1])->count();
            $data = (object)array(
                'res_code' => 1,
                'like_count' => $count_like
            );
            return json_encode($data);
        }else{
            return Yii::t('book','This Book not found from Databse! Book_Naimen_');
        }

    }

    public function actionClearLikes(){
        $this->layout = false;
        $uid = Yii::$app->getuserinfo->getId();
        Yii::$app->db->createCommand("DELETE FROM liked_books WHERE user_id = '$uid' and status = 1")->execute();
        $user_likes = (new \yii\db\Query())
            ->select(['DISTINCT(bm.naimen)', 'lb.book_naimen_id', 'bm.book_author', 'lb.book_type'])
            ->from('liked_books lb')
            ->innerJoin('library.book_main bm', 'lb.book_naimen_id = bm.book_naimen_id')
            ->where(['user_id' => $uid])->andWhere(['status' => 1])->groupBy('lb.book_naimen_id')
            ->all();
        return $this->render('like-modal', compact('user_likes'));
    }

    public function actionDelItemLike(){
        $id = Yii::$app->request->get('id');
        $uid = Yii::$app->getuserinfo->getId();
        $query = Yii::$app->db->createCommand("DELETE FROM liked_books WHERE user_id = '$uid' and status = '1' and book_type='O' and book_naimen_id = '$id'");
        if(!$query->execute()){
            return false;
        }
        $this->layout = false;
        $user_likes = (new Query())
            ->select(['DISTINCT(bm.naimen)', 'lb.book_naimen_id', 'bm.book_author', 'lb.book_type'])
            ->from('liked_books lb')
            ->innerJoin('library.book_main bm', 'lb.book_naimen_id = bm.book_naimen_id')
            ->where(['user_id' => $uid])->andWhere(['status' => 1, 'book_type' => 'O'])
            ->groupBy('lb.book_naimen_id')
            ->all();
        $user_likes_ebook = (new Query())
            ->select(['ebook_id', 'title', 'author', 'ebk_img', 'ebl.book_type'])
            ->from('liked_books ebl')
            ->innerJoin('elibrary.ebook e', 'ebl.book_naimen_id = e.ebook_id')
            ->where(['user_id' => $uid])->andWhere(['status' => 1, 'book_type' => 'E'])
            ->all();

        return $this->render('like-modal', ['user_likes' => $user_likes, 'us_eb_like' => $user_likes_ebook]);
    }

    public function actionShowLikes(){
        $uid = Yii::$app->getuserinfo->getId();
        $this->layout = false;
        $user_likes = (new Query())
            ->select(['DISTINCT(bm.naimen)', 'lb.book_naimen_id', 'bm.book_author', 'lb.book_type'])
            ->from('liked_books lb')
            ->innerJoin('library.book_main bm', 'lb.book_naimen_id = bm.book_naimen_id')
            ->where(['user_id' => $uid])->andWhere(['status' => 1, 'book_type' => 'O'])
            ->groupBy('lb.book_naimen_id')
            ->all();
        $user_likes_ebook = (new Query())
            ->select(['ebook_id', 'title', 'author', 'ebk_img', 'ebl.book_type'])
            ->from('liked_books ebl')
            ->innerJoin('elibrary.ebook e', 'ebl.book_naimen_id = e.ebook_id')
            ->where(['user_id' => $uid])->andWhere(['status' => 1, 'book_type' => 'E'])
            ->all();

        return $this->render('like-modal', ['user_likes' => $user_likes, 'us_eb_like' => $user_likes_ebook]);
    }

    public function actionMyFavoriteBooks(){
        $uid = Yii::$app->getuserinfo->getId();
        $user_likes = (new Query())
            ->select(['DISTINCT(bm.naimen)', 'lb.book_naimen_id', 'bm.book_author', 'lb.book_type'])
            ->from('liked_books lb')
            ->innerJoin('library.book_main bm', 'lb.book_naimen_id = bm.book_naimen_id')
            ->where(['user_id' => $uid])->andWhere(['status' => 1, 'book_type' => 'O'])
            ->groupBy('lb.book_naimen_id')
            ->all();
        $user_likes_ebook = (new Query())
            ->select(['ebook_id', 'title', 'author', 'ebk_img', 'ebl.book_type'])
            ->from('liked_books ebl')
            ->innerJoin('elibrary.ebook e', 'ebl.book_naimen_id = e.ebook_id')
            ->where(['user_id' => $uid])->andWhere(['status' => 1, 'book_type' => 'E'])
            ->all();
        return $this->render('my-favorite-books', ['user_likes' => $user_likes, 'us_eb_like' => $user_likes_ebook]);
    }

    public function actionDelete($id, $type){
        $uid = Yii::$app->getuserinfo->getId();
        $query = Yii::$app->db->createCommand("DELETE FROM liked_books WHERE user_id = '$uid' and status = '1' and book_type='$type' and book_naimen_id = '$id'");
        if(!$query->execute()){
            return false;
        }
        return $this->redirect(['my-favorite-books']);
    }
}