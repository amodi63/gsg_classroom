<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopicScope implements Scope
{
    /** 
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user_id = Auth::id();
         $builder->whereHas('classroom', function (Builder $query) use ($user_id) {
            $query->where('user_id', '=', $user_id); 
         });
    }
}
