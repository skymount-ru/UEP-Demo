<?php

use yii\db\Migration;

/**
 * Class m200401_094419_group_chat_message
 */
class m200401_094419_group_chat_message extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%group_chat_message}}', [
            'id' => $this->primaryKey(),
            'message' => $this->text(),
            'user_id' => $this->integer(),
            'group_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('{{%fk-group_chat_message-user}}', '{{%group_chat_message}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%fk-group_chat_message-group}}', '{{%group_chat_message}}', 'group_id', '{{%group}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%group_chat_message}}');
    }
}
