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
        Schema::create('site_infos', function (Blueprint $table) {
            $table->id();
            
            // Basic Site Info
            $table->string('site_name')->nullable();
            $table->string('site_tagline')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('footer_logo')->nullable();

            // Contact Info
            $table->string('phone_primary')->nullable();
            $table->string('phone_secondary')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('email')->nullable();
            $table->string('support_email')->nullable();

            // Address
            $table->string('address_line')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->text('google_map_embed')->nullable();

            // Social
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('linkedin')->nullable();

            // Travel Business Info
            $table->string('trade_license')->nullable();
            $table->string('iata_number')->nullable();
            $table->string('tagline_travel')->nullable();
            $table->text('about_short')->nullable();
            $table->longText('about_full')->nullable();


            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('og_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_infos');
    }
};
