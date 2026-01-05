<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Degree extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id','degree_name', 'status','disable'
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
     public function users()
    {
        return $this->hasMany(User::class);
    }

     public function savings()
    {
        return $this->hasMany(Saving::class);
    }
    public function paymentDetails()
    {
        return $this->hasMany(PaymentDetail::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
