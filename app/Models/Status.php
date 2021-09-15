<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    //定义需要交互的数据库
    protected $table = 'statuses';

/*    public function user()
    {
        return $this->belongsTo(User::class);
    }*/
}
