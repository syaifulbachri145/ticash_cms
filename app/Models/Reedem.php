<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reedem extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'institution_id', 'user_id', 'amount','status','disable'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

}
