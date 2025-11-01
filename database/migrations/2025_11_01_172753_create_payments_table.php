<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            
            // 💡 Foreign Keys
            $table->foreignId('billing_id')->constrained('billings')
                  ->onUpdate('cascade') 
                  ->onDelete('restrict');
                  
            $table->foreignId('customer_id')->constrained('customers')
                  ->onUpdate('cascade') 
                  ->onDelete('restrict');
                  
            // এখানে ধরে নেওয়া হচ্ছে যে 'collected_by' হলো 'users' টেবিলের আইডি
            $table->foreignId('collected_by')->nullable()->constrained('users')
                  ->onUpdate('cascade') 
                  ->onDelete('restrict'); 
                  
            // 💡 ডেটা কলাম
            $table->enum('payment_method', ['cash', 'bKash', 'card', 'bank']);
            $table->string('transaction_id', 100)->nullable();
            $table->decimal('amount', 10, 2);
            $table->timestamp('payment_date')->default(now());
            
            $table->timestamps();
            
            // 💡 ঐচ্ছিক: billing_id এবং transaction_id ইউনিক করা যেতে পারে যদি একটি বিলের একাধিক পেমেন্ট না নিতে চান।
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};