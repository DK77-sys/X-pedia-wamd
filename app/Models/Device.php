<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'number', 'webhook', 'status'];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('number', 'like', '%' . $query . '%');
    }
}