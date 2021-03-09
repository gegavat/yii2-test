<?php

use yii\db\Migration;

/**
 * Class m210309_201812_create_add_admin_user
 */
class m210309_201812_create_add_admin_user extends Migration
{
    // @codingStandardsIgnoreEnd

    /**
     * Table name
     *
     * @var string
     */
    private $_user = "{{%user}}";

    /**
     * Runs for the migrate/up command
     *
     * @return null
     */
    public function safeUp()
    {
        $time = time();
        $password_hash = Yii::$app->getSecurity()->generatePasswordHash('admin');
        $auth_key = Yii::$app->security->generateRandomString();
        $table = $this->_user;

        $sql = <<<SQL
        INSERT INTO {$table}
        (`username`, `auth_key`, `password_hash`, `email`, `created_at`, `updated_at`)
        VALUES
        ('admin', '$auth_key', '$password_hash', 'admin@admin.com', {$time}, {$time})
SQL;
        Yii::$app->db->createCommand($sql)->execute();

    }

    /**
     * Runs for the migate/down command
     *
     * @return null
     */
    public function safeDown()
    {
        $table = $this->_user;
        $sql = <<<SQL
        SELECT id from {$table}
        where username='admin'
SQL;
        $id = Yii::$app->db->createCommand($sql)->execute();
        $this->delete($this->_user, ['username' => 'admin']);
    }

}
