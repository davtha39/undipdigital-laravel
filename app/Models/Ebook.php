<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Ebook extends Model
{
    use HasFactory;
    protected $primaryKey = 'ebook_id';
    protected $table = 'ebook';
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
