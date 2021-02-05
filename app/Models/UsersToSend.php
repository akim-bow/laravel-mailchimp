<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersToSend extends Model
{
    protected $table = 'users_to_send';
    protected $fillable = ['name', 'surname', 'email', 'subscribed', 'sync_at'];
}
