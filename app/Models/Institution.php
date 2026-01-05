<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Institution extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'institution_code','referral_code','institution_name', 'address','contact','email','image','balance','admin_fee','shared_fee','profit','invoice','bank_transfer','account_number','account_name', 'status',  'chat_id','disable'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function students()
    {
        return $this->hasMany(User::class);
    }
    public function merchants()
    {
        return $this->hasMany(Merchant::class);
    }
    public function degrees()
    {
        return $this->hasMany(Degree::class);
    }
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
    public function claims()
    {
        return $this->hasMany(Claim::class);
    }
    public function reedem()
    {
        return $this->belongsTo(Reedem::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function payment_details()
    {
        return $this->hasMany(PaymentDetail::class);
    }
    public function savings()
    {
        return $this->hasMany(Saving::class);
    }
    public function gethers()
    {
        return $this->hasMany(Gether::class);
    }
    public function gether_members()
    {
        return $this->hasMany(GetherMember::class);
    }
   
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('/storage/institutions/' . $value),
        );
    }

}
