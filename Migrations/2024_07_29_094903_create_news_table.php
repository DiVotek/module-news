<?php

use App\Models\StaticPage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\News\Models\News;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(News::getDb(), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('sorting')->default(0);
            $table->string('image')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('views')->default(0);
            $table->string('source')->nullable();
            $table->text('author')->nullable();
            News::timestampFields($table);
        });
        StaticPage::createSystemPage('News','news');
    }

    public function down(): void
    {
        Schema::dropIfExists(News::getDb());
    }
};
