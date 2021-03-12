<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use app\models\Apple;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $applesFromTree = Apple::find()
            ->where(['status' => 'on_tree'])
            ->all();
        $applesOnGround = Apple::find()
            ->where(['status' => 'on_ground'])
//            ->orderBy('fallen_at ASC')
            ->all();
        $applesSpoiled = Apple::find()
            ->where(['status' => 'spoiled'])
            ->all();

        // проверка на гнилые яблоки
        $fallenAtArray = array_column( $applesOnGround, 'fallen_at', 'id' );
        foreach ( $fallenAtArray as $id => $dbTime ) {
            // если прошло 5 часов после падения, меняем статус на Гнилое
            if (  time() - $dbTime > 18000 ) {
                $apple = Apple::findOne($id);
                $apple->status = 'spoiled';
                $apple->update();
                Yii::warning('Яблоко №' . $id . ' испортилось');
            }
        }

        $applesOnGround = array_merge($applesOnGround, $applesSpoiled);

        return $this->render('index', compact(
            'applesFromTree',
            'applesOnGround'
        ));
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
