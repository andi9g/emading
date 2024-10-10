<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kontenM extends Model
{
    use HasFactory;
    protected $table = 'konten';
    protected $primaryKey = 'idkonten';
    protected $connection = 'mysql';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser','iduser');
    }
}
