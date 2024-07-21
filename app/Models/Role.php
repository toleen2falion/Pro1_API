<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'user_id',
    ];

    // public function getPermissionsAttribute($permissions){
    //     return json_decode($permissions,true);
    // }

        ///////////9
// public function Permissions(){
//     return $this->hasMany(Permission::class,'role_id');
public function Permissions(){
    return $this->belongsToMany(Permission::class,'role__permissions');
}
// }
}
