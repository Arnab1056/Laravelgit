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
        Schema::create('Pharmacy', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable(); // Make location nullable
            $table->string('email')->unique();
            $table->string('phone')->nullable(); // Make phone nullable
            $table->integer('role')->default(3); // Ensure role has a default value of 3
            $table->unsignedBigInteger('user_id'); // Add user_id as foreign key
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Automatically get all values from users table and add to Pharmacy table, set phone and location to null
        DB::table('Pharmacy')->insert(
            DB::table('users')
                ->select('name', 'email', 'role', 'id as user_id', DB::raw('NULL as location'), DB::raw('NULL as phone'))
                ->distinct('email')
                ->get()
                ->toArray()
        );
    }

    public function down()
    {
        Schema::dropIfExists('Pharmacy'); // Ensure the table name matches the one in the up method
    }
};

