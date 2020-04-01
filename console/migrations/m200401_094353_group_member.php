<?php

use yii\db\Migration;

/**
 * Class m200401_094353_group_member
 */
class m200401_094353_group_member extends Migration
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

        $this->createTable('{{%group_member}}', [
            'user_id'  => $this->integer()->notNull(),
            'group_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-group_member-user-group}}', '{{%group_member}}', ['user_id', 'group_id'], true);

        $this->addForeignKey('{{%fk-group_member-user}}', '{{%group_member}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('{{%fk-group_member-group}}', '{{%group_member}}', 'group_id', '{{%group}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%group_member}}');
    }
}
