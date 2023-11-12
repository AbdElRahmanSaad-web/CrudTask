<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partition extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_id',
        'name_en',
        'name_ar'
    ];

    public function Category(){
        return $this->belongsTo(Category::class, 'cat_id');
    }
}
