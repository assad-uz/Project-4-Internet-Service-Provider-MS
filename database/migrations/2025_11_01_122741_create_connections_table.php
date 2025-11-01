<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->id();
            
            // 💡 Foreign Keys
            $table->foreignId('customer_id')->constrained('customers')
                  ->onUpdate('cascade') 
                  ->onDelete('restrict');
                  
            $table->foreignId('package_id')->constrained('packages')
                  ->onUpdate('cascade') 
                  ->onDelete('restrict'); 
                  
            $table->foreignId('distribution_box_id')->constrained('distribution_boxes')
                  ->onUpdate('cascade') 
                  ->onDelete('restrict'); 
                  
            // 💡 ডেটা কলাম
            $table->string('username', 100)->unique();
            $table->string('password', 255); // এটি হ্যাশ করা হবে না, তাই VARCHAR
            $table->string('ip_address', 50)->nullable();
            $table->string('mac_address', 20)->nullable();
            $table->unsignedSmallInteger('box_port_number')->nullable();
            
            // 💡 ENUM/Date Fields
            $table->enum('connection_type', ['Optical Fiber', 'CAT-5', 'UTP']);
            $table->date('connection_date');
            $table->enum('status', ['active', 'suspended', 'terminated'])->default('active');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('connections');
    }
};