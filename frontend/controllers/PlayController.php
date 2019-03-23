<?php
namespace frontend\controllers;

use backend\models\Result;
use backend\models\TaskSentence;
use backend\models\TaskWord;
use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * Site controller
 */
class PlayController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionSelectTask()
    {
        $task = TaskSentence::find()->select('sentence_id')->where(['is_block' => 0])->asArray()->all();
        return $this->render('select-task', [
            'tasks' => $task
        ]);
    }

    public function actionDecision($task){

        $task = TaskWord::find()->where(['is_block' => 0])
            ->andWhere(['sentence_id' => $task])
            ->orderBy('rand()')
            ->asArray()->all();
        return $this->render('decision', [
            'words' => $task
        ]);
    }

    public function actionCheckResult(){
        $text = Yii::$app->request->post('text');
        $task_id =  Yii::$app->request->post('id_task');
        $uid = Yii::$app->user->getId();
        $task = TaskSentence::find()->select('senctence')->where(['sentence_id' => $task_id])->asArray()->one();
        $check_answer = Result::find()->where(['user_id' => $uid])->andWhere(['sentence_id' => $task_id])->one();
        $count_all = TaskSentence::find()->where(['is_block' => 0])->count();
        if(empty($check_answer)){
            $is_answered = 0;
        }else{
            $is_answered = 1;
        }


        $result = new Result();

        if(mb_strtolower(trim($text)) == mb_strtolower(trim($task['senctence']))){
            
            if($is_answered == 0){
                $result->sentence_id = $task_id;
                $result->user_id = $uid;
                $result->type = 'win';
                $result->is_block = 0;
                $result->save();
                unset($result);
            }else{
                Yii::$app->db->createCommand('UPDATE result SET type="win" WHERE sentence_id = '.$task_id.' AND user_id = '.$uid)->execute();
            }
            $wins = Result::find()
                ->where(['user_id' => $uid])
                ->andWhere(['type' => 'win'])
                ->andWhere(['is_block' => 0])->count();
            $loses = Result::find()
                ->where(['user_id' => $uid])
                ->andWhere(['type' => 'lose'])
                ->andWhere(['is_block' => 0])->count();            
            $data = (object)array(
                'status' => true,
                'data' => 'Вы распознали замысел автора!',
                'wins' => $wins,
                'loses' => $loses,
                'played' => $wins+$loses,
                'avg_win' => round(($wins/$count_all)*100, 2),
                'avg_lose' => round(($loses/$count_all)*100, 2),
            );
            
        }else{
           
            if($is_answered == 0){
                $result->sentence_id = $task_id;
                $result->user_id = $uid;
                $result->type = 'lose';
                $result->is_block = 0;
                $result->save();
                unset($result);
            }else{
                Yii::$app->db->createCommand('UPDATE result SET type="lose" WHERE sentence_id = '.$task_id.' AND user_id = '.$uid)->execute();
            }
            $wins = Result::find()
                ->where(['user_id' => $uid])
                ->andWhere(['type' => 'win'])
                ->andWhere(['is_block' => 0])->count();
            $loses = Result::find()
                ->where(['user_id' => $uid])
                ->andWhere(['type' => 'lose'])
                ->andWhere(['is_block' => 0])->count();
            $data = (object)array(
                'status' => false,
                'data' => 'Увы, автор думал иначе!',
                'wins' => $wins,
                'loses' => $loses,
                'played' => $wins+$loses,
                'avg_win' => round(($wins/$count_all)*100, 2),
                'avg_lose' => round(($loses/$count_all)*100, 2),
            );
        }


        return json_encode($data);
    }
}
