<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    protected $fillable = [
        'role'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'role_id');
    }
}
