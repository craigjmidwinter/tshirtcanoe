<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('user_code')->unique();
	        $table->enum('status',['unapproved','active','moderator'])->default('unapproved');
	        $table->string('avatar_url')->nullable();
	        $table->string('name');
	        $table->rememberToken();
	        $table->timestamps();
	        $table->unsignedInteger('tshirt_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
