<?php

use Faker\Factory;
use yii\db\Migration;

class m250911_165336_seed_data extends Migration
{
    public function safeUp()
    {
        $faker = Factory::create();
        for($i = 1; $i <= 10; $i++) {
            $this->insert('{{%book}}', [
                'name' => $faker->text(30),
                'issue_year' => $faker->year,
                'description' => $faker->text,
                'isbn' => $faker->isbn10(),
            ]);
        }
    }

    public function safeDown()
    {
//        $this->delete('{{%user}}', ['username' => 'admin']);
    }

}
