<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_agent',
        'ip_address',
        'content',
        'classwork_id',
        'commentable_id',
        'commentable_type'
    ];
    public function user(){
        return $this->belongsTo(USer::class)->withDefault(['name' => 'unknown User']);
    }
    public function commentable() {
        return $this->morphTo();  //prefix
    }
    
}
