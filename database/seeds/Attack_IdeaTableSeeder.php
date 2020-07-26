<?php

use Illuminate\Database\Seeder;

class Attack_IdeaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attack_idea')->insert([
            ['attack_id'=>1, 'idea_id'=>1],
            ['attack_id'=>2, 'idea_id'=>2],
            ['attack_id'=>3, 'idea_id'=>3],
            ['attack_id'=>1, 'idea_id'=>2],
        ]);
    }
}
