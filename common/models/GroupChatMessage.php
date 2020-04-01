<?php


namespace common\models;


class GroupChatMessage extends db\BaseGroupChatMessage
{
    /**
     * @param $id
     * @return array
     */
    public static function getForGroup($id): array
    {
        return static::find()
            ->where(['group_id' => $id])
            ->all();
    }
}
