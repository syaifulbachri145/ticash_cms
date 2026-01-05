<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentJournal extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
protected $guarded = [];

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
    public function institution()
    {
        return $this->belongsTo(Institution::class);
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
