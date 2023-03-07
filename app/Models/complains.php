<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\categories;
use App\Models\subcategories;
use App\Models\states;
use App\Models\User;

class complains extends Model
{
    use HasFactory;
    public $table = 'complains';
    protected $id = 'id';

    public function category()
    {
        return $this->belongsTo(categories::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(subcategories::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function state()
    {
        return $this->belongsTo(states::class);
    }
    public function staff()
    {
        return $this->belongsTo(User::class);
    }
}
