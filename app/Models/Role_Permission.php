<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_Permission extends Model
{
    use HasFactory;
    public $timestamps = false;
      protected $fillable = [
        'role_id',
        'permission_id',
    ];
}
