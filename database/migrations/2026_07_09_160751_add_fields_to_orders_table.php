<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Cek apakah kolom sudah ada sebelum menambah
            if (!Schema::hasColumn('orders', 'no_order')) {
                $table->string('no_order')->unique()->after('id');
            }
            if (!Schema::hasColumn('orders', 'jenis_pesanan')) {
                $table->enum('jenis_pesanan', ['diantar', 'ambil_toko'])->default('ambil_toko')->after('metode_pembayaran');
            }
            if (!Schema::hasColumn('orders', 'ongkir')) {
                $table->decimal('ongkir', 15, 2)->default(0)->after('total_harga');
            }
            if (!Schema::hasColumn('orders', 'alamat')) {
                $table->text('alamat')->nullable()->after('jenis_pesanan');
            }
            if (!Schema::hasColumn('orders', 'no_hp')) {
                $table->string('no_hp', 20)->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('orders', 'catatan')) {
                $table->text('catatan')->nullable()->after('no_hp');
            }
            if (!Schema::hasColumn('orders', 'status_pembayaran')) {
                $table->enum('status_pembayaran', ['belum_dibayar', 'sudah_dibayar'])->default('belum_dibayar')->after('status');
            }
            if (!Schema::hasColumn('orders', 'expired_at')) {
                $table->timestamp('expired_at')->nullable()->after('status_pembayaran');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['no_order', 'jenis_pesanan', 'ongkir', 'alamat', 'no_hp', 'catatan', 'status_pembayaran', 'expired_at']);
        });
    }
};
