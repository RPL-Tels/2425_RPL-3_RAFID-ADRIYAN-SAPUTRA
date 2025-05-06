<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ProjectData extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'data_id', 'project_name', 'file_path', 'type', 'zip_type', 'project_id', 'file_name', 'items_id', 'items_name', 'costume_name', 'extension', 'size'];
    protected $primaryKey = 'data_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public function projectData() {
        return $this->hasMany(ProjectData::class, 'project_id', 'project_id');  
    }
    public function item()
    {
        return $this->belongsTo(Project_items::class ,'items_id', 'items_id');
    }
}
