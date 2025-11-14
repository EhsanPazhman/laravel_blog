<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            // parent for threaded replies
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');

            // moderation status: pending / approved / rejected
            $table->string('status', 20)->default('pending')->index();

            // who approved (admin)
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');

            // when approved
            $table->timestamp('approved_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');

            $table->dropIndex(['status']);
            $table->dropColumn('status');

            $table->dropForeign(['approved_by']);
            $table->dropColumn('approved_by');

            $table->dropColumn('approved_at');
        });
    }
};
