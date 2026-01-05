<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */

    protected $fillable = [
        'user_id', 'institution_id', 'degree_id','nim','major','graduation', 'status','disable'
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
