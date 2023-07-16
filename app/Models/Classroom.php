<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Classroom extends Model
{
    use HasFactory;
    public static $disk = 'public' ;
    protected $fillable = ['name', 'code', 'subject', 'room', 'cover_image_path','classroom_image', 'theme','section','user_id','status'];
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($classroom) {
            $classroom->code = Str::random(8) ;
        });

      
    }
}
