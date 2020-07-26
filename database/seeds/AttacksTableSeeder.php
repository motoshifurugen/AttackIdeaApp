<?php

use Illuminate\Database\Seeder;

class AttacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attacks')->insert([
            ['attack_name'=>'はっぱカッター', 'attack_description'=>'カッターのような硬いはっぱで攻撃する'],
            ['attack_name'=>'かえんほうしゃ', 'attack_description'=>'口から火を吐く'],
            ['attack_name'=>'みずでっぽう', 'attack_description'=>'水を相手にぶつける']
        ]);
    }
}
