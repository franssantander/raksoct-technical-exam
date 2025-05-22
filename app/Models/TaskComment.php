<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{

    protected $table = 'task_comment';


    protected $fillable = [
        'task_id',
        'user_id',
        'comment',
    ];


    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
