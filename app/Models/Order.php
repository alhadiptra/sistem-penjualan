<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no_order',
        'tanggal_order',
        'total_harga',
        'ongkir',
        'metode_pembayaran',
        'jenis_pesanan',
        'alamat',
        'kecamatan', 
        'no_hp',
        'catatan',
        'status',
        'status_pembayaran',
        'expired_at',
    ];

    protected $casts = [
        'tanggal_order' => 'datetime',
        'expired_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public static function generateNoOrder()
    {
        $lastOrder = self::latest()->first();
        $lastNumber = $lastOrder ? intval(substr($lastOrder->no_order, 6)) : 0;
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        return 'ORDER-' . $newNumber;
    }
}
