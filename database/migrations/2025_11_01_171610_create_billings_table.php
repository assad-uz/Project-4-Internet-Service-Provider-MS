<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            
            // 💡 Foreign Keys
            $table->foreignId('customer_id')->constrained('customers')
                  ->onUpdate('cascade') 
                  ->onDelete('restrict');
                  
            $table->foreignId('connection_id')->constrained('connections')
                  ->onUpdate('cascade') 
                  ->onDelete('restrict'); 
                  
            $table->foreignId('package_id')->constrained('packages')
                  ->onUpdate('cascade') 
                  ->onDelete('restrict'); 
                  
            // 💡 ডেটা কলাম
            $table->date('billing_month'); // মাসের প্রথম তারিখ দিয়ে বিলিং মাস বোঝানো হবে
            $table->decimal('amount', 10, 2);
            $table->date('due_date');
            $table->decimal('discount', 10, 2)->default(0.00);
            
            // 💡 ENUM Field
            $table->enum('status', ['unpaid', 'paid', 'partially_paid', 'cancelled'])->default('unpaid');
            
            $table->timestamps();
            
            // 💡 UNIQUE KEY: একই কানেকশনের জন্য একই মাসের বিল যেন দুবার না হয়
            $table->unique(['connection_id', 'billing_month'], 'uk_connection_month');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};