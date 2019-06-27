<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 05.01.2019
 * Time: 2:00
 */

namespace app\modules\library\controllers;


use app\controllers\AppController;
use app\modules\library\models\Discipline;
use app\modules\library\models\Specialnost;
use yii\web\Controller;
use Yii;

class DependentController extends AppController
{

    public function actionKafspec($id){

        $rows = Specialnost::find()->from('specialnost s')
            ->innerJoin('book_spec bs', 's.spec_code = bs.spec_code')
            ->where(['s.kafedra_id' => $id, 's.is_block' => 0])->asArray()->all();


        echo "<option value=''>".Yii::t('app', '--- Select Specialty ---')."</option>";

        if(count($rows)>0){
            foreach($rows as $row){
                echo "<option value='".$row['spec_code']."'>".$row['spec_tj']."</option>";
            }
        }
        else{
            echo "";
        }
    }

    public function actionDiscat($id){
        $rows = Discipline::find()->where(['dis_cat_id' => $id])->andWhere(['is_block' => 0])->orderBy('discipline_name')->asArray()->all();
        if(empty($id) || $id == 0)
        $rows = Discipline::find()->Where(['is_block' => 0])->orderBy('discipline_name')->asArray()->all();
        debug($rows);
        echo "<option value=''>".Yii::t('app', '--- Select Specialty ---')."</option>";

        if(count($rows)>0){
            foreach($rows as $row){
                echo "<option value='".$row['discipline_id']."'>".$row['discipline_name']."</option>";
            }
        }
        else{
            echo "";
        }
    }
}