<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\categories;
use App\Models\User;

class StaffMapping extends Model
{   
    use HasFactory;
    public $table = 'staff_mapping';
    public function category()
    {
        return $this->belongsTo(categories::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
