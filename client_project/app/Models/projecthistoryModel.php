<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projecthistoryModel extends Model
{
    use HasFactory;
    protected $table = 'project_history';
    protected $fillable = ['project_id','items_id','name','description','status','progress', 'by'];
}
