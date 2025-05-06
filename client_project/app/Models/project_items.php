<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class project_items extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'items_id', 'items_name', 'progres', 'stage', 'category', 'price', 'file_path', 'subtotal'];
    public function data()
    {
        return $this->hasMany(ProjectData::class, 'items_id', 'items_id');
    }
    
}