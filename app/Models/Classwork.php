<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Classwork extends Model
{
    use HasFactory;

    const TYPE_ASSIGNMENT = 'assignment';
    const TYPE_MATERIAL = 'material';
    const TYPE_QUESTION = 'question';

    const STATUS_PUBLISHED = 'published';
    const STATUS_DRAFT = 'draft';
    
    protected $fillable = ['classroom_id', 'user_id', 'topic_id', 'title' , 'description','status','type', 'options', 'published_at'];
    protected $casts = ['options' => 'json'];
    protected static function booted(): void
    {
   
        static::creating(function (Classwork $classwork) {
        
            $classwork->user_id = Auth::id() ;
        
        });
    }
    public function classroom():BelongsTo {
        return $this->belongsTo(Classroom::class,'classroom_id', 'id');
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable') ; //prefix
    }
    public function topic():BelongsTo {
        return $this->belongsTo(Topic::class);
       } 

    public function users(){
        return $this->belongsToMany(User::class)->withPivot(['grade','submitted_at', 'status', 'created_at'])->using(ClassworkUser::class); 
    }
}
