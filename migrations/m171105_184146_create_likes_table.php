<?php

use yii\db\Migration;

/**
 * Handles the creation of table `records`.
 */
class m171105_184146_create_likes_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('likes', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'user_ip' => $this->string(),
            'status' => $this->integer()->defaultValue(0),
        ]);

        $this->insert('likes', [
            'post_id' => '1',
            'user_ip' => '127.0.0.1',
            'status' => '1',
        ]);

        $this->insert('likes', [
            'post_id' => '2',
            'user_ip' => '127.0.0.2',
            'status' => '0',
        ]);

        $this->insert('likes', [
            'post_id' => '3',
            'user_ip' => '127.0.0.1',
            'status' => '1',
        ]);


    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('likes');
    }
}
