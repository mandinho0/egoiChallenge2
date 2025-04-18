<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }

    /**
     * Add Sample Data
     */
    public function insertSamplaData() {
        DB::table('users')->insert([
            [
                'name'       => 'Alice Silva',
                'email'      => 'alice.silva@example.com',
                'password'   => bcrypt('password'),
                'phone'      => '+351912345678',
                'role'       => 'admin',
                'birthday'   => '1985-07-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Bruno Costa',
                'email'      => 'bruno.costa@example.com',
                'password'   => bcrypt('password'),
                'phone'      => '+351963852741',
                'role'       => 'user',
                'birthday'   => '1990-11-05',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Catarina Fernandes',
                'email'      => 'catarina.fernandes@example.com',
                'password'   => bcrypt('password'),
                'phone'      => '+351965478123',
                'role'       => 'user',
                'birthday'   => '1995-03-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Diogo Martins',
                'email'      => 'diogo.martins@example.com',
                'password'   => bcrypt('password'),
                'phone'      => '+351918273645',
                'role'       => 'admin',
                'birthday'   => '1988-12-02',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Eva Oliveira',
                'email'      => 'eva.oliveira@example.com',
                'password'   => bcrypt('password'),
                'phone'      => '+351919191919',
                'role'       => 'user',
                'birthday'   => '1993-06-30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
};
