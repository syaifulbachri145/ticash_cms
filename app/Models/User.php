<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements JWTSubject // <-- tambahkan
{
   // use HasApiTokens, HasFactory, Notifiable,  HasRoles;
      use HasFactory, Notifiable,  HasRoles;

    /**
     * guard_name
     *
     * @var string
     */
    protected $guard_name ='web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'graduation',
        'password',
        'institution_id',
        'access_id',
        'avatar',
        'address',
        'phone',
        'dob',
        'bank_transfer',
        'account_number',
        'account_name',
        'va_number',
        'card_number',
        'pin_number',
        'balance',
        'degree_id',
        'nim',
        'is_limit',
        'limitation',
        'status',
        'disable',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * getPermissionArray
     *
     * @return void
     */
    public function getPermissionArray()
    {
        return $this->getAllPermissions()->mapWithKeys(function($pr){
            return [$pr['name'] => true];
        });
   
    }

    /**
     * getJWTIdentifier
     *
     * @return void
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
        
    /**
     * getJWTCustomClaims
     *
     * @return void
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    //relation one to many
    public function access()
    {
        return $this->belongsTo(Access::class);
    }
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
    public function reedem()
    {
        return $this->belongsTo(Reedem::class);
    }
    // relation has many
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
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
    public function claim()
    {
        return $this->hasMany(Claim::class);
    }
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value != '' ? url('/storage/users/' . $value) : 'https://ui-avatars.com/api/?name=' . str_replace(' ', '+', $this->name) . '&background=4e73df&color=ffffff&size=100',
        );
    }

}