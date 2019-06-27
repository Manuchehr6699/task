<?php

namespace app\modules\library\controllers;


use Yii;
use app\modules\library\models\Book;
use app\modules\library\models\BookSearch;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use app\controllers\AppController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use app\modules\library\models\Category;
use app\modules\library\models\Discipline;
use app\modules\library\models\Kafedra;
use app\modules\library\models\DisciplineCategory;
use app\modules\library\models\Specialnost;
use app\modules\library\models\SystemSearch;
use app\modules\library\models\BookDiscipline;


/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SystemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        }

       // throw new NotFoundHttpException(Yii::t('book', 'The requested page does not exist.'));
    }

    public function actionListBooks(){
        switch (Yii::$app->language){
            case 'ru':
                $lang = 1;
                break;
            case 'en':
                $lang = 2;
                break;
            default:
                $lang = 3;
                break;
        }

        $title = Html::encode(Yii::$app->request->get('book_title'));
        $author = Html::encode(Yii::$app->request->get('author'));
        $publisher = Html::encode(Yii::$app->request->get('publisher'));
        if(Yii::$app->request->isPost){
            unset($title);
            unset($author);
            unset($publisher);
        }
        $kafedra = Html::encode($_GET['Kafedra']['kafedra_id']);
        $specialty = Html::encode($_GET['Specialnost']['spec_code']);
        $dis_c = Html::encode($_GET['DisciplineCategory']['dis_cat_id']);
        $disp = Html::encode($_GET['Discipline']['discipline_id']);

        if(!empty($title)){
            $query = Book::find()->select('  bm.book_naimen_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->where(['b.flagDel' => 'n'])
                ->andWhere(['bm.is_block' => 0])->andWhere(['LIKE', 'bm.naimen', $title])
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);
            $is_search = 1;
            $result_count = $query->count();
        }elseif (!empty($author)){
            $query = Book::find()->select('  bm.book_naimen_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->where(['b.flagDel' => 'n'])
                ->andWhere(['bm.is_block' => 0])->andWhere(['LIKE', 'bm.book_author', $author])
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);
            $is_search = 1;
            $result_count = $query->count();
        }elseif (!empty($publisher)){
            $query = Book::find()->select('  bm.book_naimen_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->innerJoin('book_nashriyot bn', 'bn.nashriyot_id = bm.nashriyot_id')
                ->where(['b.flagDel' => 'n'])
                ->andWhere(['bm.is_block' => 0])->andWhere(['LIKE', 'bn.nashriyot', $publisher])
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);
            $is_search = 1;
            $result_count = $query->count();
        }elseif (!empty($kafedra) && empty($specialty)){
            $query = Book::find()->select('  bm.book_naimen_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->innerJoin('book_spec bs', 'bs.naimen_id = bm.book_naimen_id')
                ->innerJoin('specialnost s', 'bs.spec_code = s.spec_code')
                ->innerJoin('kafedra k', 'k.kafedra_id = s.kafedra_id')
                ->where(['b.flagDel' => 'n'])
                ->andWhere(['bm.is_block' => 0])
                ->andWhere(['bs.status' => 1])
                ->andWhere(['s.kafedra_id' => $kafedra])
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);

        }elseif (!empty($specialty)){
            $query = Book::find()->select('  bm.book_naimen_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->innerJoin('book_spec bs', 'bs.naimen_id = bm.book_naimen_id')
                ->innerJoin('specialnost s', 'bs.spec_code = s.spec_code')
                ->where(['b.flagDel' => 'n'])
                ->andWhere(['bm.is_block' => 0])
                ->andWhere(['bs.status' => 0])
                ->andWhere(['s.spec_code' => $specialty])
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);
            $is_spec = $specialty;
            $result_count = $query->count();
        }elseif(!empty($dis_c) && empty($disp)){
            $query = Book::find()->select('  bm.book_naimen_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->innerJoin('book_discipline bd', 'bd.naimen_id = bm.book_naimen_id')
                ->innerJoin('discipline d', 'd.discipline_id = bd.discipline_id')
                ->innerJoin('discipline_category dc', 'dc.dis_cat_id = d.dis_cat_id')
                ->where(['b.flagDel' => 'n'])
                ->andWhere(['bm.is_block' => 0])
                ->andWhere(['bd.is_block' => 0])
                ->andWhere(['d.dis_cat_id' => $dis_c])
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);
        }elseif (!empty($disp)){
            $query = Book::find()->select('bm.book_naimen_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->innerJoin('book_discipline bd', 'bd.naimen_id = bm.book_naimen_id')
                ->innerJoin('discipline d', 'd.discipline_id = bd.discipline_id')
                ->innerJoin('discipline_category dc', 'dc.dis_cat_id = d.dis_cat_id')
                ->where(['b.flagDel' => 'n'])
                ->andWhere(['bm.is_block' => 0])
                ->andWhere(['bd.is_block' => 0])
                ->andWhere(['d.discipline_id' => $disp])
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);
        }
        else {
            $query = Book::find()->select('bm.book_naimen_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->where(['b.flagDel' => 'n'])
                ->andWhere(['bm.is_block' => 0])->andWhere(['bm.book_language_id' => $lang])
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);
        }
        $pages = new Pagination(['totalCount' => $query->count(),
            'pageSize' => 12,
            'forcePageParam' => false,
            'pageSizeParam' => false
            ]);
        $books = $query->offset($pages->offset)->limit($pages->limit)->all();
//        $kafedra = Kafedra::find()->select('kafedra_id, kafedra_taj, kafedra_sokr_taj, status_of_kaf')->where(['status_of_kaf' => 'on'])->asArray()->all();
        $kafedra = new Kafedra();
//        $dis_cat = DisciplineCategory::find()->where(['is_block' => 0])->asArray()->all();
        $dis_cat = new DisciplineCategory();
        $dis = new Discipline();
        $spec = new Specialnost();


        return $this->render('list-books', [
            'books' => $books,
            'pages' => $pages,
            'is_search' => $is_search,
            'result_count' => $result_count,
            'kafedra' => $kafedra,
            'spec' => $spec,
            'dis_cat' => $dis_cat,
            'dis' => $dis,
            'is_spec' => $is_spec
        ]);
    }


    public function actionListBooksSidebar(){
        $title = Yii::$app->request->get('book_title');
        $author = Yii::$app->request->get('author');
        $publisher = Yii::$app->request->get('publisher');
        $category = Yii::$app->request->get('category');
        $title = Html::encode($title);
        $author = Html::encode($author);
        $publisher = Html::encode($publisher);
        $category = Html::encode($category);
        if(!empty($title)){
            $query = Book::find()->select('  bm.book_naimen_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->where(['b.flagDel' => 'n'])
                ->andWhere(['bm.is_block' => 0])->andWhere(['LIKE', 'bm.naimen', $title])
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);
            $res_count = $query->count();
            $is_search = 1;
        }elseif(!empty($author)){
            $query = Book::find()->select('  bm.book_naimen_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->where(['b.flagDel' => 'n'])
                ->andWhere(['bm.is_block' => 0])->andWhere(['LIKE', 'bm.book_author', $author])
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);
            $res_count = $query->count();
            $is_search = 1;
        }
        elseif(!empty($publisher)){
            $query = Book::find()->select('  bm.book_naimen_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->innerJoin('book_nashriyot bn', 'bn.nashriyot_id = bm.nashriyot_id')
                ->where(['b.flagDel' => 'n'])
                ->andWhere(['bm.is_block' => 0])->andWhere(['LIKE', 'bn.nashriyot', $publisher])
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);
            $res_count = $query->count();
            $is_search = 1;
        }
        elseif(!empty($category)){
            $query = Book::find()->select('bm.book_naimen_id, bm.cat_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->where(['b.flagDel' => 'n'])
                ->andWhere(['bm.cat_id' => $category])
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);
            $res_count = $query->count();
            $is_search = 1;
            $is_cat = Category::find()->select('category')->where(['category_id' => $category])->asArray()->one();
        }else {
            $query = Book::find()->select('  bm.book_naimen_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->where(['b.flagDel' => 'n'])
                ->andWhere(['bm.is_block' => 0])
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);
            unset($is_search);
            $res_count = $query->count();
        }
        $pages = new Pagination(['totalCount' => $query->count(),
            'pageSize' => 21,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);
        $books = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('list-books-sidebar', [
            'books' => $books,
            'pages' => $pages,
            'is_search' => $is_search,
            'is_cat' => $is_cat['category'],
            'is_title' => $title,
            'is_author' => $author,
            'is_publisher' => $publisher,
            'result_count' => $res_count
        ]);
    }

    public function actionViewBookDetails(){
        $id = Yii::$app->request->get('id');
        $details = Book::find()->select(['bm.book_naimen_id', 'bm.naimen', 'bm.book_author', 'libs.lib_name', 'bm.soli_nashr',
            'bm.cd', 'bm.floppy', 'bm.stilaz', 'bm.polka', 'bs.seriya_name', 'bcat.category', 'bc.cover_type', 'bl.language',
            'bm.format', 'bm.ISBN', 'bm.BBK', 'bm.UDK', 'bj.joi_nashr', 'bn.nashriyot', 'bm.count_page', 'bm.describe',
            'COUNT(b.book_id) AS book_count'])
            ->from('book_main bm')
            ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
            ->innerJoin('libraries libs', 'libs.library_id=b.lib_id')
            ->innerJoin('book_nashriyot bn', 'bn.nashriyot_id = bm.nashriyot_id')
            ->innerJoin('book_seriya bs', 'bs.seriya_id = bm.seriya_id')
            ->innerJoin('book_joi_nashr bj', 'bm.joi_nashr_id = bj.joi_nashr_id')
            ->innerJoin('book_cover_type bc', 'bm.cover_id = bc.cover_id')
            ->innerJoin('book_category bcat', 'bm.cat_id = bcat.category_id')
            ->innerJoin('book_language bl', 'bm.book_language_id=bl.language_id')
            ->where(['bm.book_naimen_id' => $id])
            ->andWhere(['b.flagDel' => 'n'])
            ->andWhere(['bm.is_block' => 0])
            ->groupBy('b.naimen_id')->asArray()->one();

        return $this->render('view-book-details', ['data' => $details]);
    }


    public function actionModalDetail()
    {
        $this->layout = false;
        $id = Yii::$app->request->get('id');
        $details = Book::find()->select(['bm.book_naimen_id', 'bm.naimen', 'bm.book_author', 'bm.soli_nashr', 'libs.lib_name',
        'bm.cd', 'bm.floppy', 'bm.stilaz', 'bm.polka', 'bs.seriya_name', 'bcat.category', 'bc.cover_type', 'bl.language',
            'bm.format', 'bm.ISBN', 'bm.BBK', 'bm.UDK', 'bj.joi_nashr', 'bn.nashriyot', 'bm.count_page', 'bm.describe',
            'COUNT(b.book_id) AS book_count'])
            ->from('book_main bm')
            ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
            ->innerJoin('libraries libs', 'libs.library_id=b.lib_id')
            ->innerJoin('book_nashriyot bn', 'bn.nashriyot_id = bm.nashriyot_id')
            ->innerJoin('book_seriya bs', 'bs.seriya_id = bm.seriya_id')
            ->innerJoin('book_joi_nashr bj', 'bm.joi_nashr_id = bj.joi_nashr_id')
            ->innerJoin('book_cover_type bc', 'bm.cover_id = bc.cover_id')
            ->innerJoin('book_category bcat', 'bm.cat_id = bcat.category_id')
            ->innerJoin('book_language bl', 'bm.book_language_id=bl.language_id')
            ->where(['bm.book_naimen_id' => $id])
            ->andWhere(['b.flagDel' => 'n'])
            ->andWhere(['bm.is_block' => 0])
            ->groupBy('b.naimen_id')->asArray()->one();

        return $this->render('modal-detail', ['book' => $details]);
    }

    public function actionSearchByFirstLetter(){
        $letter = Html::encode(Yii::$app->request->get('letter'));
        if(!empty($letter) && $letter == '*') {
            $query = Book::find()->select('  bm.book_naimen_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->where(['b.flagDel' => 'n'])
                ->andwhere("bm.naimen REGEXP '^[0-9]'")
                ->orWhere("bm.naimen REGEXP '^[\"\'.,!~`@#$%^&*<>_-]'")
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);
            $is_search = 1;
            $res_count = $query->count();
        }elseif(!empty($letter) && $letter != '*'){
            $query = Book::find()->select('  bm.book_naimen_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->where(['b.flagDel' => 'n'])
                ->andwhere("bm.naimen LIKE '$letter%'")
                ->andWhere(['bm.is_block' => 0])
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);
            $is_search = 1;
            $res_count = $query->count();
        }else {
            $query = Book::find()->select('  bm.book_naimen_id, bm.naimen, bm.book_author, bm.book_language_id, COUNT(b.book_id) AS book_count')
                ->from('book_main bm')
                ->innerJoin('book b', 'bm.book_naimen_id = b.naimen_id')
                ->where(['b.flagDel' => 'n'])
                ->andWhere(['bm.is_block' => 0])
                ->groupBy('b.naimen_id')->orderBy(['(book_count)' => SORT_DESC]);
            unset($is_search);
            $res_count = $query->count();
        }
        $pages = new Pagination(['totalCount' => $query->count(),
            'pageSize' => 20,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);
        $books = $query->offset($pages->offset)->limit($pages->limit)->all();
        $rusLet = array('А','Б','В','Г','Ғ','Д','Е','Ё','Ж','З','И','К','Қ','Л','М','Н','О','П','Р','С','Т','У','Ӯ','Ф','Х','Ҳ','Ц','Ч','Ҷ','Ш','Щ','Э','Ю','Я');
        $engLet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',);


        return $this->render('search-by-first-letter', [
            'books' => $books,
            'pages' => $pages,
            'is_search' => $is_search,
            'result_count' => $res_count,
            'rusLet' => $rusLet,
            'engLet' => $engLet,
            'let' => $letter
        ]);
    }


    public function actionDependBooksToDisciplines($id){

        if(Yii::$app->user->isGuest){
            return $this->goHome();
        }

        $model = new BookDiscipline();
        $items = ArrayHelper::map(Discipline::find()->where(['is_block' => 0])->asArray()->all(), 'discipline_id', 'discipline_name');
        $naimen = Book::find()->where(['book_naimen_id' => $id])->asArray()->one();
        if(Yii::$app->request->post()){
            $arr = $_POST['BookDiscipline']['discipline_id'];
            $n_id = $_POST['BookDiscipline']['naimen_id'];
            if(count($arr) > 10) {
                Yii::$app->session->setFlash('depend_error', Yii::t('book', 'You may choose maximum 10 disciplines. Please, try again!'));
                return $this->redirect('/library/book/books-for-disciplines');
            }
                if(!empty($arr)){

                    foreach ($arr as $dis_id) {
                        $bookDis = new BookDiscipline();
                        $bookDis->naimen_id = $n_id;
                        $bookDis->discipline_id = $dis_id;
                        $bookDis->lot_id = 1;
                        $bookDis->is_block = 1;
                        $bookDis->book_id_start = Yii::$app->getuserinfo->getId();
                        $bookDis->save();
                        unset($bookDis);
                    }
                }else{
                    return $this->redirect('/library/book/books-for-disciplines');
                }
            Yii::$app->session->setFlash('depend_success', Yii::t('book', 'Book Was Successfully Depended To Disciplines. Thank You!'));
            return $this->redirect('/library/book/books-for-disciplines');
        }
        return $this->render('depend-books-to-discipline', [
            'model' => $model,
            'items' => $items,
            'book_naimen_id' => $id,
            'book_naimen' => $naimen,
        ]);

    }


    public function actionBooksForDisciplines(){

        $data = Book::find()->select(['bm.book_naimen_id', 'bm.naimen', 'bm.book_author',  'bm.soli_nashr',
            'bcat.category',  'bl.language', 'bj.joi_nashr', 'bn.nashriyot', 'bm.count_page', 'bm.describe'])
            ->from('book_main bm')
            ->innerJoin('book_nashriyot bn', 'bn.nashriyot_id = bm.nashriyot_id')
            ->innerJoin('book_seriya bs', 'bs.seriya_id = bm.seriya_id')
            ->innerJoin('book_joi_nashr bj', 'bm.joi_nashr_id = bj.joi_nashr_id')
            ->innerJoin('book_category bcat', 'bm.cat_id = bcat.category_id')
            ->innerJoin('book_language bl', 'bm.book_language_id = bl.language_id')
            ->where('bm.book_naimen_id NOT IN (Select naimen_id from book_discipline)')
            ->andWhere(['bm.is_block' => 0])
            ->groupBy('bm.naimen')->orderBy('rand()');
        $pages = new Pagination(['totalCount' => $data->count(),
            'pageSize' => 15,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);
        $count = $data->count();
        $books = $data->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('list-for-discipline', [
            'data' => $books,
            'pages' => $pages,
            'count' => $count,
        ]);
    }
}
