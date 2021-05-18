<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $connection = 'mysql';
    protected $table = 'users';

    public function getUsersById($user_id, $columns = ['*'])
    {
        return DB::table($this->table)->find($user_id, $columns);
    }
}
