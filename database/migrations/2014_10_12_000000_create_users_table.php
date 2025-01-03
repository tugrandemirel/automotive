<?php

use App\Enum\User\UserRoleEnum;
use App\Enum\User\UserStatusEnum;
use App\Models\Company;
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
            $table->id();
            $table->foreignIdFor(Company::class)->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('username');
            $table->string('phone')->nullable();
            $table->tinyInteger('role')->default(UserRoleEnum::USER->value);
            $table->boolean('status')->default(UserStatusEnum::PASSIVE->value);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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
