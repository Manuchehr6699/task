<?php

namespace backend\controllers;

use Yii;
use backend\models\TaskText;
use backend\models\TaskTextSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\TaskSentence;
use backend\models\TaskWord;

/**
 * TaskTextController implements the CRUD actions for TaskText model.
 */
class TaskTextController extends Controller
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
     * Lists all TaskText models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskTextSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaskText model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TaskText model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {


        $model = new TaskText();

        if ($model->load(Yii::$app->request->post())) {
            $text = trim($model->text);
            $model->created_at = date('Y-m-d H:i:s');
            $model->created_by = Yii::$app->user->getId();
            $model->is_block = 0;
            $model->save();
            $text_id = Yii::$app->db->lastInsertID;
            preg_match_all("/.*?[.?!](?:\s|$)/s", $text, $array);
            $items = $array[0];
            foreach ($items as $item) {
                $sentence = new TaskSentence();
                $sentence->senctence = trim($item);
                $sentence->text_id = $text_id;
                $sentence->is_block = 0;
                $sentence->save();
                $sentence_id = Yii::$app->db->lastInsertID;
                $words = explode(' ', $item);
                foreach ($words as $word) {
                    $w = new TaskWord();
                    $w->is_block = 0;
                    $w->word = $word;
                    $w->sentence_id = $sentence_id;
                    $w->save();
                    unset($w);
                }
                unset($sentence);
                unset($sentence_id);

            }

            return $this->redirect(['view', 'id' => $model->text_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TaskText model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->text_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TaskText model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaskText model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaskText the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaskText::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
