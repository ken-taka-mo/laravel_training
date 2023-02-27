<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{   
    const CREATED_AT = NULL;
    const UPDATED_AT = NULL;
    public $companiesCount;
    protected $fillable = [
        'name', 
        'manager_name',
        'phone_number',
        'postal_code',
        'prefecture_code',
        'address',
        'mail_address',
        'prefix',
        'created',
        'modified',
    ];

    public function __construct() {
        $this->companiesCount = Company::whereNull('deleted')->count();
    }

    public function getData($name)
    {   
        if ($name) {
            $name = "%{$name}%";
            return $this->where('name', 'LIKE', $name)->whereNull('deleted')->select('id', 'name', 'manager_name', 'phone_number', 'postal_code', 'prefecture_code', 'address', 'mail_address')->paginate(10);
        }
        return $this->whereNull('deleted')->select('id', 'name', 'manager_name', 'phone_number', 'postal_code', 'prefecture_code', 'address', 'mail_address')->paginate(10);
    }

    public function filterData($name)
    {   
        return $this->where('name', 'like', '%name%')->select('id', 'name', 'manager_name', 'phone_number', 'postal_code', 'prefecture_code', 'address', 'mail_address')->offset($offset)->limit(10)->get();
    }

    public function store($request)
    {   
        $this->create(['name' => $request['name'],
            'manager_name' => $request['manager_name'],
            'phone_number' => $request['phone_number'],
            'postal_code' => $request['postal_code'],
            'prefecture_code' => $request['prefecture_code'],
            'address'=> $request['address'],
            'mail_address' => $request['mail_address'],
            'prefix' => $request['prefix'],
            'created' => NOW(),
            'modified' => NOW(),
        ]);
        return;
    }

    public function softDelete($request)
    {
        $this->where('id', $request->get('id'))->update(['deleted' => NOW(), 'modified' => NOW()]);
        return;
    }

    public function getDetail($id)
    {
        return $this->where('id', $id)->get();
    }

    public function updateDetail($id, $request)
    {
        $this->where('id', $id)->update(['name' => $request['name'],
            'manager_name' => $request['manager_name'],
            'phone_number' => $request['phone_number'],
            'postal_code' => $request['postal_code'],
            'prefecture_code' => $request['prefecture_code'],
            'address'=> $request['address'],
            'mail_address' => $request['mail_address'],
            'modified' => NOW(),
        ]);
        return;
    }
}