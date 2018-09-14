<?php

use yii\db\Migration;

/**
 * Class m180913_104532_add_foreign_keys
 */
class m180913_104532_add_foreign_keys extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        // creates index for column `author_id`
        $this->createIndex(
            'idx-loan-user_id',
            'loan',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-loan-user_id',
            'loan',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-loan-user_id',
            'loan'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-loan-user_id',
            'loan'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180913_104532_add_foreign_keys cannot be reverted.\n";

        return false;
    }
    */
}
