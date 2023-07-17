<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'classroom_id', 'user_id'];
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($topic) {
            $topic->user_id = 1 ;
        });

      
    }
    public $timestamps = false;
}
