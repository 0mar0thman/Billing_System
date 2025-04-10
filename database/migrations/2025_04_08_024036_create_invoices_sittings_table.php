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
        Schema::create('invoices_sittings', function (Blueprint $table) {
            $table->id();
            $table->decimal('Amount_collection' , 8,2); // قيمة التحصيل
            $table->decimal('Amount_Commission', 8,2); //نسبة العمولة
            $table->decimal('Discount_Commission', 8,2); // نسبة الخصم
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices_sittings');
    }
};
