<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserScope implements Scope
{
    /** 
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if($user_id = Auth::id()){
         $builder->where(function(Builder $q) use($user_id){
            $q->where('user_id', $user_id);
         }  )->orWhereExists(function($query) use ($user_id){
            $query->select(DB::raw(1))->from('classroom_user')->whereColumn('classroom_id', 'classrooms.id')->where('user_id', $user_id);
         });
        }
    }
}
