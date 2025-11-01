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
        Schema::create('distribution_boxes', function (Blueprint $table) {
            $table->id();
            
            // 💡 আপনার স্কিমা অনুযায়ী কলাম যোগ করা হলো
            $table->string('box_code', 50)->unique(); 
            $table->string('name', 150)->nullable();
            
            // Foreign Key Setup
            $table->foreignId('area_id')->constrained('areas') // areas টেবিলের সাথে সম্পর্ক
                  ->onUpdate('cascade') 
                  ->onDelete('restrict'); // এই এরিয়াতে বক্স থাকলে এরিয়া ডিলিট করা যাবে না

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribution_boxes');
    }
};
