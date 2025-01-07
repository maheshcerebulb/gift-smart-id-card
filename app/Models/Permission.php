<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as Model;
use Illuminate\Support\Facades\Auth;

class Permission extends Model
{

    public $table = 'permissions';

    public $fillable = [
        'name',
        'guard_name',
        'module',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'guard_name' => 'string',
        'module' => 'string'
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = Auth::user() ? Auth::user()->id : NULL;
        });
    }

    protected $appends = array('permission_data');

    public function getPermissionDataAttribute()
    {
        return $this->permissions->pluck('id', 'id');
    }

    public function scopeFilter($query)
    {
        $userDetails = Auth::user();
        if($userDetails->accessScope && $userDetails->accessScope->name == 'Group'){
            $currentGroupUser = User::whereHas('accessScope', function($q) {
                                        $q->where('name', '!=', 'Global');
                                    })
                                    ->whereHas('groups', function($q) use($userDetails){
                                        $q->whereIn('id', $userDetails->groups->pluck('id'));
                                    })
                                ->pluck('id');

            $query->whereIn('created_by',$currentGroupUser);

        }else if($userDetails->accessScope && $userDetails->accessScope->name == 'Individual'){
            $query->where('created_by',$userDetails->id);
        }
        return $query;
    }

    public function permissionModule(){
        return $this->belongsTo(Module::class,'module');
    }

    public function messages() 
    {
        return ['name.*.unique' => 'Firstname of the user is required'];
    }   


}
