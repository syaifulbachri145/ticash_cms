<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'trans_number','user_id', 'institution_id', 'transaction_category_id','destination_id','type','description','amount','admin_fee','shared_fee', 'status','disable'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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

    /**
     * updatedAt
     *
     * @return Attribute
     */
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-M-Y'),
        );
    }



}
