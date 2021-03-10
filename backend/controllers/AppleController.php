<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Apple;


class AppleController extends Controller {

    public function actionGenerate($color) {
        if ( !Yii::$app->request->isAjax ) exit;
        $apple = new Apple();
        $apple->color = $color;
        if ( !$apple->save() ) Yii::warning($apple->errors);
    }

}