<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
class Classroom extends Model
{
    use HasFactory;
    public static $disk = 'public' ;
    protected $fillable = ['name', 'code', 'subject', 'room', 'cover_image_path','classroom_image', 'theme','section','user_id','status'];
    protected static function booted(): void
    {
        static::addGlobalScope(new UserScope);
        static::creating(function (Classroom $classroom) {
            $classroom->code = Str::random(8) ;
            $classroom->user_id = auth()->id() ;
        
        });
    }
    public function classworks():HasMany {
        return $this->hasMany(Classwork::class,'classroom_id', 'id');
    }
    public function scopeActive($query, $status = "active")
    {
        $query->where('status', $status);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function users() {
        return $this->belongsToMany(User::class, 'classroom_user','classroom_id', 'user_id')->withPivot(['role', 'created_at']);
    }
    public function teachers(){
        return $this->users()->wherePivot('role', 'teacher');
    }
    public function students(){
        return $this->users()->wherePivot('role', 'student');
    }
   public function topics():HasMany {
    return $this->hasMany(Topic::class);
   } 
    
}
