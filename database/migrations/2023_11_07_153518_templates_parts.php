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

        Schema::create('scheme_template_parts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schemeTemplate_id');
            $table->unsignedBigInteger('schemePart_id');
            $table->integer('parent_part_id')->nullable();
            $table->integer('order');
            $table->string('condition');
            $table->string('display_text');
            $table->timestamps();

            $table->foreign('schemeTemplate_id')->references('id')->on('scheme_templates');
            $table->foreign('schemePart_id')->references('id')->on('scheme_parts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheme_template_parts');
    }
};
