<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use SoftDEletes;

    protected $fillable = [
        'name',
        'manager_name',
        'phone_number',
        'postal_code',
        'prefecture_code',
        'address',
        'mail_address',
        'prefix',
    ];

    // companiesテーブルのデータを取得
    public function getCompanies($order, $name)
    {
        // orderパラメータがdesc以外の時はnullに
        if ($order != 'desc') {
            $order = null;
        }
        // 会社名検索されているときのクエリビルダ
        if ($name) {
            $name = "%{$name}%";
            return $this->where('name', 'LIKE', $name)
            ->select('id', 'name', 'manager_name', 'phone_number', 'postal_code', 'prefecture_code', 'address', 'mail_address')
            ->when($order, function($query, $order) {$query->orderBy('id', $order);})
            ->paginate(10);
        }
        return $this->select('id', 'name', 'manager_name', 'phone_number', 'postal_code', 'prefecture_code', 'address', 'mail_address')
        ->when($order, function($query, $order) {$query->orderBy('id', $order);})
        ->paginate(10);
    }
    // 会社データ作成
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
        ]);
    }
    // 会社データソフトデリート
    public function softDelete($id)
    {
        $this->where('id', $id)->delete();
    }

    // 特定のidのレコード取得
    public function getDetail($id)
    {
        return $this->where('id', $id)->first();
    }

    // 会社データ更新
    public function updateDetail($id, $request)
    {
        $this->where('id', $id)->update(['name' => $request['name'],
            'manager_name' => $request['manager_name'],
            'phone_number' => $request['phone_number'],
            'postal_code' => $request['postal_code'],
            'prefecture_code' => $request['prefecture_code'],
            'address'=> $request['address'],
            'mail_address' => $request['mail_address'],
        ]);
    }
}
