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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, textarea, image, json, boolean
            $table->string('group')->default('general'); // general, hero, headmaster, admissions, contact, stats
            $table->timestamps();
        });

        Schema::create('academic_programs', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->string('title');
            $table->text('description');
            $table->json('features')->nullable();
            $table->string('link_label')->default('Learn More');
            $table->string('link_url')->default('#admissions');
            $table->string('icon')->default('school');
            $table->string('accent_bar')->default('bg-primary');
            $table->string('icon_bg')->default('bg-primary-fixed');
            $table->string('icon_color')->default('text-primary');
            $table->string('label_color')->default('text-primary');
            $table->string('link_color')->default('text-primary');
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('campus'); // academics, sports, arts, campus
            $table->string('category_label')->default('Campus Grounds');
            $table->text('description')->nullable();
            $table->text('image_path');
            $table->text('alt_text')->nullable();
            $table->string('span_class')->default('lg:col-span-4');
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('admission_requirements', function (Blueprint $table) {
            $table->id();
            $table->text('requirement_text');
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('parent_name');
            $table->string('parent_phone');
            $table->string('parent_email');
            $table->string('class_level');
            $table->string('boarding_status')->default('Boarding');
            $table->text('message')->nullable();
            $table->boolean('consent')->default(true);
            $table->string('status')->default('new'); // new, contacted, enrolled, closed
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('admission_requirements');
        Schema::dropIfExists('gallery_items');
        Schema::dropIfExists('academic_programs');
        Schema::dropIfExists('site_settings');
    }
};
