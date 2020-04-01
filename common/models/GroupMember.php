<?php


namespace common\models;

use yii\helpers\Console;

class GroupMember extends db\BaseGroupMember
{

    /**
     * @param $groupId
     * @param $user_id
     * @return array
     */
    public static function addUser($groupId, $user_id): array
    {
        $model = new static([
            'group_id' => $groupId,
            'user_id' => $user_id,
        ]);

        if (!$model->save()) {
            throw new \yii\base\InvalidValueException('Unable to add the user to the group. ' . Console::errorSummary($model));
        }

        return $model->group->groupMembers;
    }

    /**
     * @param $groupId
     * @return array
     * @throws \yii\base\ErrorException
     */
    public static function getForGroup($groupId): array
    {
        $group = Group::findOne($groupId);
        if (!$group) {
            throw new \yii\base\ErrorException('Group not found.');
        }

        return $group->groupMembers;
    }
}
