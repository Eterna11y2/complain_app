<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\categories;
class subcategories extends Model
{   
    public function category()
    {
        return $this->belongsTo(categories::class);
    }
    use HasFactory;
    public $table = 'subcategories';
    protected $id = 'id';
}
