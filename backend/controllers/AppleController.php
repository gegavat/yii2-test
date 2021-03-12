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
        return $apple->color;
    }

    public function actionEat($id, $piece) {
        if ( !Yii::$app->request->isAjax ) exit;
        $apple = Apple::findOne($id);
        if ( $apple->status === 'on_tree' ) {
            Yii::error('Нельзя кусать с дерева');
            exit;
        }
        if ( $apple->status === 'spoiled' ) {
            Yii::error('Нельзя кусать гнилое яблоко');
            exit;
        }
        if ( $apple->residue < $piece ) {
            Yii::error('Нельзя откусить больше, чем осталось');
            exit;
        }
        // если откусили последний кусок, удаляем яблоко из БД
        if ( $apple->residue == $piece ) {
            $apple->delete();
        } else {
            $apple->residue = $apple->residue - $piece;
            $apple->update();
        }
        return $apple->residue;
    }

}