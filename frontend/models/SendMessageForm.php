<?php


namespace frontend\models;


use yii\base\Model;

class SendMessageForm extends Model
{
    public $group_id;
    public $message;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'message'], 'required'],
            ['group_id', 'integer'],
            ['message', 'string'],
        ];
    }
}
