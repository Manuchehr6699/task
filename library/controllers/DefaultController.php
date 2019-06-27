<?php

namespace app\modules\library\controllers;

use app\controllers\AppController;
use yii\web\Controller;

/**
 * Default controller for the `library` module
 */
class DefaultController extends AppController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
