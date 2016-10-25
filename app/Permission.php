<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Permission extends Authenticatable
{
    protected $visible = array('read', 'write');
    protected $fillable = ['user_id', 'read', 'write'];
}
