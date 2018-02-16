<?php

namespace bulldozer\feedback\console\migrations;

use bulldozer\App;
use bulldozer\users\rbac\DbManager;
use yii\base\InvalidConfigException;
use yii\db\Migration;

/**
 * Class m180216_195851_init_tables
 */
class m180216_195851_init_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%feedback}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(11)->unsigned(),
            'updated_at' => $this->integer(11)->unsigned(),
            'creator_id' => $this->integer(11)->unsigned(),
            'updater_id' => $this->integer(11)->unsigned(),
            'name' => $this->string(255),
            'email' => $this->string(255),
            'phone' => $this->string(30),
            'comment' => $this->text(),
            'status' => $this->smallInteger(2)->unsigned(),
        ], $tableOptions);

        $authManager = $this->getAuthManager();

        $permission = $authManager->createPermission('feedback');
        $permission->name = 'Доступ к обратной связи';
        $authManager->add($permission);

        $admin = $authManager->getRole('admin');
        $authManager->addChild($admin, $permission);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%feedback}}');

        $authManager = $this->getAuthManager();

        $managePages = $authManager->getPermission('feedback');
        $authManager->remove($managePages);
    }

    /**
     * @throws InvalidConfigException
     * @return DbManager
     */
    protected function getAuthManager()
    {
        $authManager = App::$app->getAuthManager();

        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }

        return $authManager;
    }
}
