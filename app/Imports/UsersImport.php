<?php
  
namespace App\Imports;
  
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Hash;
  
class UsersImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        return new User([
        'institution_id'    => $row['institution_id'],
        'access_id'         => $row['access_id'],
        'degree_id'         => $row['degree_id'],
        'nim'               => $row['nim'],
        'name'              => $row['name'],
        'email'             => $row['email'], 
        'password'          => Hash::make($row['password']),
        'avatar'            => $row['avatar'],
        'phone'             => $row['phone'],
        'address'           => $row['address'],
        'dob'               => $row['dob'],          
        'balance'           => $row['balance'],
        'graduation'        => $row['graduation'],
        'va_number'         => $row['va_number'],
        'card_number'       => $row['card_number'],
        'pin_number'        => $row['pin_number'],
        'bank_transfer'     => $row['bank_transfer'],
        'account_number'    => $row['account_number'],
        'account_name'      => $row['account_name'],
        'is_limit'          => $row['is_limit'],
        'limitation'        => $row['limitation'],
        'status'            => $row['status'],
        'disable'           => $row['disable'],  
        ]);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function rules(): array
    {
        return [
            'institution_id'    => 'required',
            //'access_id'         => 'required',
            'name'              => 'required',
            //'password'          => 'required|min:5',
            'email'             => 'required|email|unique:users'
        ];
    }
}