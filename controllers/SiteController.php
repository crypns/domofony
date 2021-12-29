<?php

namespace app\controllers;

use app\models\ApartmentComplex;
use app\models\Cart;
use app\models\ComplexProduct;
use app\models\HomeSlider;
use app\models\PopularProduct;
use app\models\YoutubeSlider;
use app\widgets\Header;
use phpDocumentor\Reflection\Types\Object_;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use app\models\default\LoginForm;
use app\models\default\ContactForm;
use app\models\default\SignupForm;
use app\models\default\VerifyEmailForm;
use app\models\default\PasswordResetRequestForm;
use app\models\default\ResendVerificationEmailForm;
use app\models\default\ResetPasswordForm;

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
     * @return string
     */
    public function actionIndex()
    {
        $sliders = HomeSlider::find()
            ->where([
                'complex_id' => null,
            ])
            ->orderBy('updated_at DESC')
            ->limit(10)
            ->all();

        $popular_product = PopularProduct::find()
            ->orderBy('updated_at DESC')
            ->limit(20)
            ->all();

        $youtubeSlides = YoutubeSlider::find()
            ->orderBy('updated_at DESC')
            ->limit(10)
            ->all();

        return $this->render('index', [
            'sliders' => $sliders,
            'popular_product' => $popular_product,
            'youtubeSlides' => $youtubeSlides,
        ]);

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
            if (Yii::$app->user->can('moderator')) {
                return $this->redirect(['/admin/default/index']);
            }
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

        /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
    public function actionHouse($id)
    {
        $model = ApartmentComplex::findModel($id);
        $youtubeSlides = YoutubeSlider::find()
            ->orderBy('updated_at DESC')
            ->limit(10)
            ->all();

        $sliders = $model
            ->getHomeSliders()
            ->orderBy('updated_at DESC')
            ->limit(50)
            ->all();

        $complexProducts = $model
            ->getComplexProducts()
            ->with('product')
            ->orderBy('updated_at DESC')
            ->limit(50)
            ->all();


        return $this->render('house', [
            'youtubeSlides' => $youtubeSlides,
            'model' => $model,
            'sliders' => $sliders,
            'complexProducts' => $complexProducts,
        ]);



    }



    public function actionSearchApartments($query)
    {
        $expression = new \yii\db\Expression("'%$query%'");
        $apartments = ApartmentComplex::find()
            ->where(['ILIKE', 'name', $expression])
            ->orWhere(['ILIKE', 'address', $expression])
            ->orWhere(['ILIKE', 'description', $expression])
            ->all();

        $return = \yii\helpers\ArrayHelper::map($apartments, function ($element) {
            return \yii\helpers\Url::to(['/site/house', 'id' => $element['id']]);
        }, 'name');

        return json_encode($return);
    }


    public function actionSuccess()
    {

        return $this->render('success',[

        ]);
    }
    public function actionMakePurchases()
    {

    }

}


