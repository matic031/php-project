<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionTomProject()
    {
        // Assuming you're using an ActiveDataProvider, but you can change this based on your needs
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => \app\models\TomProject::find(),
        ]);
    
        return $this->render('tom-project', [
            'dataProvider' => $dataProvider,
        ]);
    }

    // SiteController.php
    public function actionCreate()
{
    $model = new \app\models\TomProject();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['index']); 
    }

    return $this->render('create-tom-project', [
        'model' => $model,
    ]);
}


public function actionUpdateTomProject($id)
{
    $model = \app\models\TomProject::findOne($id);

    if ($model === null) {
        throw new \yii\web\NotFoundHttpException('The requested Tom Project does not exist.');
    }

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view-tom-project', 'id' => $model->id]);
    }

    return $this->render('update-tom-project', [
        'model' => $model,
    ]);
}

public function actionDeleteTomProject($id)
{
    $model = \app\models\TomProject::findOne($id);

    if ($model !== null) {
        $model->delete();
    }

    return $this->redirect(['tom-project']);
}

public function actionViewTomProject($id)
{
    // Load the TomProject model using the provided ID
    $model = \app\models\TomProject::findOne($id);

    if ($model === null) {
        throw new \yii\web\NotFoundHttpException('The requested Tom Project does not exist.');
    }

    // Render the 'view-tom-project' view, passing the model
    return $this->render('view-tom-project', [
        'model' => $model,
    ]);
}


}
