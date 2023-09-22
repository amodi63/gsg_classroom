<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected function email(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => ucfirst(strtolower($value)),
        );
    }

    public function classrooms() {
        return $this->belongsToMany(Classroom::class, 'classroom_user','user_id','classroom_id')->withPivot(['role', 'created_at']);
    }
    public function classworks() {
        return $this->belongsToMany(Classwork::class)->using(ClassworkUser::class)->withPivot(['grade','status', 'submitted_at' , 'created_at']);
    }
    public function createdClassroom(){
        return $this->hasMany(Classroom::class,'user_id');
    }
    public function getAvatarAttribute() {
        return "https://ui-avatars.com/api/?name=$this->name";
    }
   public function comments(){
    return $this->hasMany(Comment::class, 'user_id');
   }

}
