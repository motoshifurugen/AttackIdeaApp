<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttackIdeaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attack_idea', function (Blueprint $table) {
            $table->unsignedBigInteger('attack_id');
            $table->unsignedBigInteger('idea_id');
            $table->primary(['attack_id', 'idea_id']);

            //外部キー制約
            $table->foreign('attack_id')
                ->references('id')
                ->on('attacks')
                ->onDelete('cascade');
            $table->foreign('idea_id')
                ->references('id')
                ->on('ideas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attack_idea');
    }
}
