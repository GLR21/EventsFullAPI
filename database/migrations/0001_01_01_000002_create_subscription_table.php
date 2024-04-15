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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ref_user')->constrained(
                'users', 'id'
            );
            $table->foreignId('ref_event')->constrained(
                'events', 'id'
            );
            $table->index( 'ref_user' );
            $table->index( 'ref_event' );
            $table->timestamp('dt_subscription')->nullable();
            $table->timestamp('dt_unsubscription')->nullable();
            $table->timestamp('dt_checkin')->nullable();
            $table->timestamp('dt_email_sent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
