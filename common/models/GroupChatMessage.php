<?php


namespace common\models;


use yii\behaviors\TimestampBehavior;
use yii\helpers\Console;

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

    /**
     * @param $groupId
     * @param string $message
     * @return bool
     * @throws \Exception
     */
    public static function post($groupId, string $message): bool
    {
        if (empty($message)) {
            return false;
        }

        if ($groupId === null) {
            $groupIds = Group::find()->select('id')->column();
        } else {
            $groupIds = [$groupId];
        }

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            foreach ($groupIds as $id) {
                $model = new GroupChatMessage([
                    'message'  => $message,
                    'user_id'  => \Yii::$app->user->id,
                    'group_id' => $id,
                ]);
                $model->created_at = time();
                if (!$model->save()) {
                    throw new \yii\base\InvalidValueException('Unable to post a message to the group.' . Console::errorSummary($model));
                }
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        return true;
    }
}
