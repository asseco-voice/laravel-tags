<?php

declare(strict_types=1);

use Asseco\BlueprintAudit\App\MigrationMethodPicker;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaggablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('taggables', function (Blueprint $table) {
            $table->id();

            if (config('asseco-tags.migrations.uuid')) {
                $table->foreignUuid('tag_id')->constrained()->cascadeOnDelete();
                $table->uuidMorphs('taggable');
            } else {
                $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
                $table->morphs('taggable');
            }

            $table->timestamps();

            $table->unique(['tag_id', 'taggable_type', 'taggable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('taggables');
    }
}
