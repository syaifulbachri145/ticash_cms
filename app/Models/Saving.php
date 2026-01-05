<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Saving extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_name', 'institution_id', 'degree_id','degree_name','balance','goal','description','deadline','status','disable'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }



}
