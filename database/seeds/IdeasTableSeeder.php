<?php

use Illuminate\Database\Seeder;

class IdeasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ideas')->insert([
            ['user_id'=>2, 'monster_name'=>'フシギダネ', 'attribute'=>'くさ', 'region'=>'a', 'size'=>7.4, 'weight'=>7],
            ['user_id'=>2, 'monster_name'=>'ヒトカゲ', 'attribute'=>'ほのお,ドラゴン', 'region'=>'a', 'size'=>6.5, 'weight'=>7],
            ['user_id'=>2, 'monster_name'=>'ゼニガメ', 'attribute'=>'みず', 'region'=>'a', 'size'=>4.9, 'weight'=>7]
        ]);
    }
}
