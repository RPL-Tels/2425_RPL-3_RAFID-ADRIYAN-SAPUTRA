<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class invoice extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_number', 'clients_id', 'total_amount', 'status', 'due_date', 'project_id', 'created_by'];
    public function user() {
        return $this->belongsTo(User::class, 'clients_id', 'user_id');
    }
    public function project()
    {
        return $this->hasMany(projectDetail::class, 'project_id', 'project_id');
    }
}
