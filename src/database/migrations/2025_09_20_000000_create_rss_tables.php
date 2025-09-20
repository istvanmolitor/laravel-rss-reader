<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rss_feeds', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('url');
            $table->timestamp('last_fetched_at')->nullable();
            $table->timestamps();
        });

        Schema::create('rss_feed_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rss_feed_id')->constrained('rss_feeds')->cascadeOnDelete();
            $table->string('guid')->nullable()->index();
            $table->string('title')->nullable();
            $table->string('link')->unique();
            $table->text('description')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rss_feed_items');
        Schema::dropIfExists('rss_feeds');
    }
};
