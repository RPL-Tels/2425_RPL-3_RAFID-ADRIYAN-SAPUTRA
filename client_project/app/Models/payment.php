<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class payment extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_id', 'amount', 'payment_date', 'payment_method'];
}