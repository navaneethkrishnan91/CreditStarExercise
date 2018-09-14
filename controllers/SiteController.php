<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\Models\User;
use app\models\Loan;
use app\models\Users;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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

    /**
     * Displays test page.
     *
     * @return string
     */
    public function actionAll()
    {
        $user = new Users;
        $loan = new Loan;

        $request = Yii::$app->request; 

        if ($user->load($request->post())) {
            $userData = $request->post('Users');
            $user->setAttributes([
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'email' => $userData['email'],
                'phone' => $userData['phone'],
                'active' => $userData['active'],
                'dead' => $userData['dead'],
                'lang' => $userData['lang']
            ], true);
            $user->insert();

            Yii::$app->getSession()->setFlash('success', 'New user added');
        }

        if ($loan->load($request->post())) {
            $loanData = $request->post('Loan');
            $loan->setAttributes([
                'user_id' => $loanData['user_id'],
                'amount' => $loanData['amount'],
                'interest' => $loanData['interest'],
                'start_date' => date("m/d/Y",strtotime($loanData['start_date'])),
                'end_date' => date("m/d/Y",strtotime($loanData['end_date'])),
                'campaign' => $loanData['campaign'],
            ], true);
            $loan->insert();

            Yii::$app->getSession()->setFlash('success', 'New loan added');
        }
        
        return $this->render('myActions', [
            'user' => $user,
            'loan' => $loan
        ]);
    }
}
