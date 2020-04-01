<?php

namespace frontend\modules\api\controllers;

use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\User';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['authMethods'][] = [
            'class' => HttpBearerAuth::class,
        ];

        return $behaviors;
    }
}
