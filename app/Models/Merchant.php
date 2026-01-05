<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Merchant extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'institution_id', 'user_id','banner','no_ktp','description', 'status','merchant_name','disable'
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function banner(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('/storage/merchants/' . $value),
        );
    }    

}
