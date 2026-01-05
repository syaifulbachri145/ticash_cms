<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gether extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'user_id','degree_id','degree_name','user_name', 'institution_id', 'balance','goal','deadline','description','status','disable'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function gether_members()
    {
        return $this->hasMany(GetherMember::class);
    }
}
