<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ModelHasRole
 *
 * @property $role_id
 * @property $model_type
 * @property $model_id
 *
 * @property Role $role
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ModelHasRole extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['role_id', 'model_type', 'model_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class, 'role_id', 'id');
    }
    
}
