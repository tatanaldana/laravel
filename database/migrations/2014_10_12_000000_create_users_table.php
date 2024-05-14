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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('doc')->unique();
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('tipo_doc', 10);
            $table->string('password');
            $table->string('tel', 11);
            $table->string('email', 50);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->date('fecha_naci');
            $table->string('genero', 50);
            $table->string('direccion', 50);
            $table->timestamps();
            $table->unsignedBigInteger('rol_id')->nullable();
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('set null');
            $table->primary('doc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
