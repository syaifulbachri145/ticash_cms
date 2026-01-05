<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'institution_id','referral_code', 'amount','bank_transfer','account_name','description','status','disable'
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
