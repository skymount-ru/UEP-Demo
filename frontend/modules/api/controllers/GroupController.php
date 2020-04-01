<?php

namespace frontend\modules\api\controllers;

use common\models\GroupChatMessage;
use common\models\GroupMember;
use common\models\User;
use Exception;
use Yii;
use yii\base\ErrorException;
use yii\db\ActiveRecord;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\UnauthorizedHttpException;

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
     * @return array|ActiveRecord[]
     */
    public function actionMessages($id)
    {
        return GroupChatMessage::getForGroup($id);
    }

    /**
     * @param $id
     * @param $user_id
     * @return array
     * @throws Exception
     */
    public function actionAddUser($id, $user_id)
    {
        return GroupMember::addUser($id, $user_id);
    }

    /**
     * @param $id
     * @return mixed
     * @throws ErrorException
     */
    public function actionMembers($id)
    {
        return GroupMember::getForGroup($id);
    }

    /**
     * Sends a chat message.
     *
     * @param $id
     * @param bool $skipUserCheck
     * @return array
     * @throws UnauthorizedHttpException
     */
    public function actionPostMessage($id, $skipUserCheck = false)
    {
        if (!$skipUserCheck && GroupMember::checkIfUserInGroup($id) === false) {
            throw new UnauthorizedHttpException();
        }

        return [
            'result' => GroupChatMessage::post($id, (string) Yii::$app->request->post('message')),
        ];
    }

    /**
     * Sends messages to the all chats.
     *
     * @return array
     * @throws Exception
     */
    public function actionBroadMessage()
    {
        if (Yii::$app->user->identity->role !== User::ROLE_ADMIN) {
            throw new UnauthorizedHttpException();
        }

        return $this->actionPostMessage(null, true);
    }
}
