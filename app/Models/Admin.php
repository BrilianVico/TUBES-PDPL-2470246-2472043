<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'username',
        'password_hash',
    ];

    protected $hidden = [
        'password_hash',
    ];

    // Laravel membaca kolom password melalui method ini
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public $timestamps = false;
}
