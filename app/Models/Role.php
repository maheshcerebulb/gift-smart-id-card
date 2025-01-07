<?php

namespace App\Models;

use Spatie\Permission\Models\Role as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Role extends Model
{

    public $table = 'roles';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'guard_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'guard_name' => 'string'
    ];

    protected $appends = array('permission_data');
    public function getPermissionDataAttribute()
    {
        return $this->permissions->pluck('id', 'id');
    }


}
