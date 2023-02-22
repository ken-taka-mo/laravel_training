<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{   
    protected $fileable = ['name', 'manager_name', 'phone_number', 'postal_code', 'prefecture_code', 'address', 'mail_address', 'prefix'];
    const CREATED_AT = NULL;
    const UPDATED_AT = NULL;

    public function getAll()
    {
        return Company::where('deleted', NULL)->get();
    }

    public function create($request)
    {
        $request->validate([
            'name' => 'required|max:64',
            'manager_name' => 'required|max:32',
            'phone_number' => 'required|regex:/^\d{1,11}$/',
            'postal_code' => 'required|regex:/^\d{7}$/',
            'prefecture_code' => 'required|numeric|min:1|max:47',
            'address'=> 'required|max:100',
            'mail_address' => 'required|max:100|regex:/^[a-zA-Z0-9_+-]+(\.[a-zA-Z0-9_+-]+)*@[a-zA-Z0-9_+-]+(\.[a-zA-Z0-9_+-]+)*$/',
            'prefix' => 'required|regex:/^[a-zA-Z0-9]{1,8}$/'
        ]);
        Company::insert(['name' => $request->get('name'),
            'manager_name' => $request->get('manager_name'),
            'phone_number' => $request->get('phone_number'),
            'postal_code' => $request->get('postal_code'),
            'prefecture_code' => $request->get('prefecture_code'),
            'address'=> $request->get('address'),
            'mail_address' => $request->get('mail_address'),
            'prefix' => $request->get('prefix'),
            'created' => NOW(),
            'modified' => NOW(),
        ]);
        return;
    }

    public function softDelete($request)
    {
        Company::where('id', $request->get('id'))->update(['deleted' => NOW(), 'modified' => NOW()]);
        return;
    }

    public function getDetail($id)
    {
        return Company::where('id', $id)->get();
    }

    public function updateDetail($id, $request)
    {
        Company::where('id', $id)->update(['name' => $request->get('name'),
            'manager_name' => $request->get('manager_name'),
            'phone_number' => $request->get('phone_number'),
            'postal_code' => $request->get('postal_code'),
            'prefecture_code' => $request->get('prefecture_code'),
            'address'=> $request->get('address'),
            'mail_address' => $request->get('mail_address'),
            'modified' => NOW(),
        ]);
        return;
    }
}