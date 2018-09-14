<?php

use yii\db\Migration;

/**
 * Class m180913_013817_seed_loans_to_table_from_json
 */
class m180913_013817_seed_loans_to_table_from_json extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $jsonFile = file_get_contents('loans.json');
        $loans = json_decode($jsonFile);

        foreach($loans as $loan) {
            $this->insert('loan', [
                'user_id' => $loan->user_id,
                'amount' => $loan->amount,
                'interest' => $loan->interest,
                'duration' => $loan->duration,
                'start_date' => date("Y-m-d H:i:s", $loan->start_date),
                'end_date' => date("Y-m-d H:i:s", $loan->end_date),
                'campaign' => $loan->campaign,
                'status' => $loan->status
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180913_013817_seed_loans_to_table_from_json cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180913_013817_seed_loans_to_table_from_json cannot be reverted.\n";

        return false;
    }
    */
}
