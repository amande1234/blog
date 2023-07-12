<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            
             
            $table->biginteger('post_id')->unsigned()->change();
            $table->foreign('post_id')->references('id')->on('post')->onUpdate('cascade')->onDelete('cascade');
  
                
            $table->biginteger('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
  
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->dropForeign('post_id');
        $table->dropColumn('post_id'); 

        $table->dropForeign('user_id');
        $table->dropColumn('user_id');
    }
};
