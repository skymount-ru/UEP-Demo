<?php

namespace frontend\modules\api\controllers;

use common\models\Group;
use common\models\GroupChatMessage;
use common\models\GroupMember;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class GroupController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\Group';

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

    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionMessages($id)
    {
        return GroupChatMessage::getForGroup($id);
    }

    /**
     * @param $id
     * @param $user_id
     * @return array
     * @throws \Exception
     */
    public function actionAddUser($id, $user_id)
    {
        return GroupMember::addUser($id, $user_id);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \yii\base\ErrorException
     */
    public function actionMembers($id)
    {
        return GroupMember::getForGroup($id);
    }
}
