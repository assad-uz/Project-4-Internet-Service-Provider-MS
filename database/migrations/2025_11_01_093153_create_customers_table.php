<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            
            // 💡 ডেটা কলাম
            $table->string('name', 150);
            $table->string('phone', 20)->unique();
            $table->string('email', 100)->nullable()->unique();
            $table->text('address');
            
            // 💡 Foreign Keys
            $table->foreignId('area_id')->constrained('areas')
                  ->onUpdate('cascade') 
                  ->onDelete('restrict');
                  
            $table->foreignId('customer_type_id')->constrained('customer_types')
                  ->onUpdate('cascade') 
                  ->onDelete('restrict'); 
                  
            // 💡 ENUM Field
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('inactive');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};