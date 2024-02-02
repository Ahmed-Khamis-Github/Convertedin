<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'admin_id', 'assigned_to_id'];



    protected static function boot()
    {
        parent::boot();

        // Listenenning for deleting event to decrement the task count in Statistics
        static::deleting(function ($task) {
            $assignedUser = $task->assignedTo;

            if ($assignedUser) {
                $assignedUser->statistics()->decrement('task_count');
            }
        });
    }

    
// relations

    // Each task belongs to an admin

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    // Each task is assigned to a user

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
}
