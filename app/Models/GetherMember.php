<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GetherMember extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'institution_id', 'gether_id','amount','goal','deadline','description','status','disable'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function gether()
    {
        return $this->belongsTo(Gether::class);
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value != '' ? url('/storage/users/' . $value) : 'https://ui-avatars.com/api/?name=' . str_replace(' ', '+', $this->name) . '&background=4e73df&color=ffffff&size=100',
        );
    }
}
