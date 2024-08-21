<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $guarded= [];

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function assignedTo(){
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function project(){
        return $this->belongsTo(project::class);
    }
}


