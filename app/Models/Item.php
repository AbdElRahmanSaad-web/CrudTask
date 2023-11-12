<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'partition_id',
        'cat_id',
        'name_en',
        'name_ar'
    ];

    public function Partition(){
        return $this->belongsTo(Partistion::class, 'partition_id');
    }
    public function Category(){
        return $this->belongsTo(Category::class, 'cat_id');
    }
}
