<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notifications extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'second_id',
        'third_id',
        'title',
        'description',
        'type',
        'type2',
        'read',
    ];

    public function project(){
        return $this->hasMany(projectDetail::class, 'project_id', 'second_id');
    }
}
