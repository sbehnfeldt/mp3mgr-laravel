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
        Schema::create('mp3_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId( 'author_id')->nullable()->references('id' )->on( 'artists' )->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId( 'album_id')->nullable()->nullOnDelete()->cascadeOnUpdate();

            $table->string( 'filename' )->unique();
            $table->string( 'filename_hash' )->unique();

            $table->string( 'title' )->nullable();
            $table->string( 'year' )->nullable();
            $table->string( 'publisher' )->nullable();
            $table->string( 'genre' )->nullable();
            $table->string( 'track' )->nullable();
            $table->string( 'composer' )->nullable();
            $table->string( 'album_author' )->nullable();
            $table->string('length' )->nullable();
            $table->string( 'ufid_owner')->nullable();
            $table->string( 'ufid_identifier')->nullable();
            $table->text( 'comments')->nullable();
            $table->binary('album_art')->nullable();
            $table->text( 'copyright')->nullable();
            $table->string( 'desc' )->nullable();
            $table->string( 'encoded' )->nullable();
            $table->string( 'url' )->nullable();
            $table->string( 'original_artist' )->nullable();
            $table->text( 'private_data')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mp3s');
    }
};
