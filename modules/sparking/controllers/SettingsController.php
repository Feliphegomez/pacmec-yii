<?php 
namespace app\modules\sparking\controllers;

use yii\web\Controller;

class SettingsController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionPrices()
    {
        return $this->render('prices');
    }
}