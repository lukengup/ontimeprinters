<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;

/**
 * Site controller
 */
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
     * @return mixed
     */
    public function actionIndex()
    {
        $data = [];
        $image = new \stdClass();
        $image->image = Yii::$app->request->baseUrl . "/images/vehicle.png";
        $image->url = null;
        $image->title = null;
        $image->description = null;
        $image->image_only = 0;
        array_push($data, $image);

        $image = new \stdClass();
        $image->image = Yii::$app->request->baseUrl . "/images/t-shirt-2.png";
        $image->url = null;
        $image->title = null;
        $image->description = null;
        $image->image_only = 0;
        array_push($data, $image);

        $image = new \stdClass();
        $image->image = Yii::$app->request->baseUrl . "/images/cap.png";
        $image->url = null;
        $image->title = null;
        $image->description = null;
        $image->image_only = 0;
        array_push($data, $image);









        $provider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['image'],
            ],
        ]);

        return $this->render('index', ['provider' => $provider]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            return $this->goBack();
        } else
        {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        $coord = new LatLng(['lat' => -26.2412600, 'lng' => 28.0674900]);
        $map = new Map([
            'center' => $coord,
            'zoom' => 14,
        ]);

// lets use the directions renderer
        $home = new LatLng(['lat' => -26.2412600, 'lng' => 28.0674900]);
        $school = new LatLng(['lat' => 39.719456079114956, 'lng' => 2.8979293346405166]);
        $onlineprinters = new LatLng(['lat' => -26.2412600, 'lng' => 28.0674900]);

// setup just one waypoint (Google allows a max of 8)
        $waypoints = [
            new DirectionsWayPoint(['location' => $onlineprinters])
        ];

        $directionsRequest = new DirectionsRequest([
            'origin' => $home,
            'destination' => $school,
            'waypoints' => $waypoints,
            'travelMode' => TravelMode::DRIVING
        ]);

// Lets configure the polyline that renders the direction
        $polylineOptions = new PolylineOptions([
            'strokeColor' => '#FFAA00',
            'draggable' => true
        ]);

// Now the renderer
        $directionsRenderer = new DirectionsRenderer([
            'map' => $map->getName(),
            'polylineOptions' => $polylineOptions
        ]);

// Finally the directions service
        $directionsService = new DirectionsService([
            'directionsRenderer' => $directionsRenderer,
            'directionsRequest' => $directionsRequest
        ]);

// Thats it, append the resulting script to the map
//$map->appendScript($directionsService->getJs());
// Lets add a marker now
        $marker = new Marker([
            'position' => $coord,
            'title' => 'Online Printers',
        ]);

// Provide a shared InfoWindow to the marker
        $marker->attachInfoWindow(
                new InfoWindow([
            'content' => '<p>13 Marjorie Street, Regents Park Johannesburg, South Africa</p>'
                ])
        );

// Add marker to the map
        $map->addOverlay($marker);

// Now lets write a polygon
        $coords = [
            new LatLng(['lat' => 25.774252, 'lng' => -80.190262]),
            new LatLng(['lat' => 18.466465, 'lng' => -66.118292]),
            new LatLng(['lat' => 32.321384, 'lng' => -64.75737]),
            new LatLng(['lat' => 25.774252, 'lng' => -80.190262])
        ];

        $polygon = new Polygon([
            'paths' => $coords
        ]);

// Add a shared info window
        $polygon->attachInfoWindow(new InfoWindow([
            'content' => '<p>This is my super cool Polygon</p>'
        ]));

// Add it now to the map
//$map->addOverlay($polygon);
// Lets show the BicyclingLayer :)
        $bikeLayer = new BicyclingLayer(['map' => $map->getName()]);

// Append its resulting script
        $map->appendScript($bikeLayer->getJs());

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->sendEmail(Yii::$app->params['adminEmail']))
            {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else
            {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else
        {
            return $this->render('contact', [
                        'model' => $model,
                        'map' => $map,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
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
        if ($model->load(Yii::$app->request->post()))
        {
            if ($user = $model->signup())
            {
                if (Yii::$app->getUser()->login($user))
                {
                    return $this->goHome();
                }
            }
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
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->sendEmail())
            {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else
            {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
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
        try
        {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e)
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword())
        {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

}
