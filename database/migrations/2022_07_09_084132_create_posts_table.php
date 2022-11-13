<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('user_id');
            $table->string('slug')->unique();
            $table->longtext('content')->nullable();
            $table->smallinteger('status')->comments(' 0: Unpublished, 1: Published 9:Deleted (Soft)')->default(0);
            $table->timestamps();
        });
        //Add MEDIUM BLOB which is unsurpported by default binary field migration
        DB::statement("ALTER TABLE posts ADD image MEDIUMBLOB NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
