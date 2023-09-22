<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Topic extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'classroom_id', 'user_id'];
    public $timestamps = false;
    protected static function booted(): void
    {
        
        static::creating(function ($topic) {
            $topic->user_id = Auth::id() ;
        });

      
    }
    
    public function classworks():HasMany {
        return $this->hasMany(Classwork::class, 'topic_id');
    }
   
}
