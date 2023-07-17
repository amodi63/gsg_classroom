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
    public function getFormattedCreatedDateAttribute()
    {
        $date = $this->attributes['created_at'];
    
        $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', $date)->locale(app()->currentLocale())->isoFormat('dddd D MMMM، YYYY');
    
        return $formattedDate;
    }
    
    public function getFormattedUpdatedDateAttribute()
    {
        $date = $this->attributes['updated_at'];

        $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', $date)->locale(app()->currentLocale())->isoFormat('dddd D MMMM');

        return $formattedDate;
    }

}
