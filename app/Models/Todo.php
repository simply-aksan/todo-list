<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['title', 'description', 'is_completed'];
    //mengatur field yang bisa diisi secara massal, yaitu title, description, dan is_completed

    protected function casts(): array
    {
        return ['is_completed' => 'boolean'];
    }
    //mengubah tipe data is_completed menjadi boolean agar bisa digunakan untuk menandai apakah todo sudah selesai atau belum
}
