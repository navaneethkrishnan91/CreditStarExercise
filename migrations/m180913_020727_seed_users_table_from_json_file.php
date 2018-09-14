<?php

use yii\db\Migration;

/**
 * Class m180913_020727_seed_users_table_from_json_file
 */
class m180913_020727_seed_users_table_from_json_file extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {    
        $jsonFile = file_get_contents('users.json');
        $users = json_decode($jsonFile);

        foreach($users as $user) {
            $this->insert('user', [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'personal_code' => $user->personal_code,
                'phone' => $user->phone,
                'active' => $user->active,
                'dead' => $user->dead,
                'lang' => $user->lang
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180913_020727_seed_users_table_from_json_file cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180913_020727_seed_users_table_from_json_file cannot be reverted.\n";

        return false;
    }
    */
}
