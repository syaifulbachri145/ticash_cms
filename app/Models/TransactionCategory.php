<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionCategory extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $guarded = [];

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

     public function payment_journals()
    {
        return $this->hasMany(PaymentJournal::class);
    }

     public function claims()
    {
        return $this->hasMany(Claim::class);
    }

  
}
