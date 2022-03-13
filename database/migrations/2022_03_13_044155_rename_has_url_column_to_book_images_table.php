<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameHasUrlColumnToBookImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_images', function (Blueprint $table) {
            $table->renameColumn('has_url', 'from_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_images', function (Blueprint $table) {
            $table->renameColumn('from_url', 'has_url');
        });
    }
}
