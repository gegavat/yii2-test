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
        $apple->save();
        return json_encode([
            'id' => $apple->id,
            'color' => $color,
        ]);
    }

    public function actionFall($id) {
        if ( !Yii::$app->request->isAjax ) exit;
        $apple = Apple::findOne($id);
        $apple->status = 'on_ground';
        $apple->fallen_at = time();
        $apple->update();
        return ($apple->color);
    }

}