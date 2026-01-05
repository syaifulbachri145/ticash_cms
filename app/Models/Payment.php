<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'user_id','title','degree_id','sequence','institution_id','transaction_category_id', 'deadline','amount','is_tuition_fee','tuition_fee','eat','laundry','description','year','status','type','disable'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function payment_details()
    {
        return $this->hasMany(PaymentDetail::class);
    }
    public function payment_journals()
    {
        return $this->hasMany(PaymentJournal::class);
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function transaction_category()
    {
        return $this->belongsTo(TransactionCategory::class);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
           //get: fn ($value) => Carbon::parse($value)->format('d-M-Y H:m:s'),
            get: fn ($value) => Carbon::parse($value)->format('d-M-Y'),
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-M-Y'),
        );
    }


}
