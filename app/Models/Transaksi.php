<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaksi extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    public $table = 'transaksi'; // dilakukan seperti ini agar tidak menjadi plural

    protected $fillable = [
        'status_pembayaran',
        'total_pembayaran',
        'nominal_uang',
        'nominal_kembalian',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('Transaksi')
        ->logFillable();
    }
}
