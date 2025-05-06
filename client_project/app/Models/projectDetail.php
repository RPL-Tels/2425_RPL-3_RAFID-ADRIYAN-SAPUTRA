<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projectDetail extends Model
{
    use HasFactory;
    protected $table = 'project_details';
    protected $fillable = ['project_id','project_name', 'client_id', 'client_name', 'tumbnail', 'description', 'progres', 'stage', 'category', 'start', 'due_contract'];

    protected $primaryKey = 'project_id'; // Menggunakan project_id sebagai primary key
    public $incrementing = false; // Jika primary key bukan integer autoincrement
    protected $keyType = 'string'; // Jika primary key berupa string

    public function projectDetail(){
        return $this->belongsTo(ProjectDetail::class, 'project_id', 'project_id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'client_id', 'user_id');
    }

    public function invoice()
    {
        return $this->belongsTo(invoice::class, 'project_id', 'project_id');
    }
    public function notif()
    {
        return $this->belongsTo(notifications::class ,'second_id', 'project_id');
    }
}
