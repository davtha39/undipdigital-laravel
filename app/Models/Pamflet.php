<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pamflet extends Model
{
    use HasFactory;
    protected $primaryKey = 'pamflet_id';
    protected $table = 'pamflet';
    protected $fillable = [
        'judul',
        'deskripsi',
        'file',
        'ukuran',
        'ext',
        'view_count'
    ];
    public $timestamps = true;
    
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'users_id');
    }
}
