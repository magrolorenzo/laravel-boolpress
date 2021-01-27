<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignCategoryPostsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {

            // Predispongo la nuova colonna che sarà la foreign key
            $table->unsignedBigInteger("category_id")->nullable()->after("slug");

            // La dichiaro chiave esterna  Specifico a quale campo fa riferimento nella tabella esterna  e come si chiama la tabella esterna
            $table->foreign("category_id")->reference("id")->on("cateogories")->onDelete('set null');

        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign("posts_category_id_foreign");
            $table->dropColumn("category_id");
        });
    }
}
