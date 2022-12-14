<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;
    // public $table = 'category'; // dilakukan seperti ini agar tidak menjadi plural
    protected static $logName = 'Category';

    protected $fillable = [
        'category_name',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('Category')
        ->logFillable();
        // ->logUnguarded();
        // ->logOnly(['name', 'description']);
        // Chain fluent methods for configuration options
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id_category', 'id');
    }
}
