<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected static $logName = 'Product';

    protected $fillable = [
        'id_category',
        'qr_code',
        'name',
        'description',
        'price',
        'stock',
        'slug',
        'expire_date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('Product')
        ->logFillable();
        // ->logUnguarded();
        // ->logOnly(['name', 'description']);
        // Chain fluent methods for configuration options
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id');
    }
}
