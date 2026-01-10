<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriUser extends Model
{
    protected $fillable = ['nama_kategori'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}