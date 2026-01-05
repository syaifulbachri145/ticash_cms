<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentDetail extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'user_id','user_name','institution_id', 'payment_id','sequence','paid','unpaid','year','is_tuition_fee','tuition_fee','eat','laundry','transaction_category_id','degree_id','amount','title','description','deadline','status','disable'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
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
            get: fn ($value) => Carbon::parse($value)->format('d-M-Y H:m:s'),
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-M-Y'),
        );
    }
}
