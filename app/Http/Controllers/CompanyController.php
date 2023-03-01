<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
  private $company;

  public function __construct(Company $company)
  {
    $this->company = $company;
  }
  // 会社データ一覧取得
  public function index(Request $request)
  {
    // パラメータのname,orderを取得
    $order = $request['order'];
    $name = $request['name'];
    // $companies = Company::getCompanies($order, $name);
    $companies = $this->company->getCompanies($order, $name);
    return view('company', compact('companies', 'name', 'order'));
  }

  public function create()
  {
    return view('create');
  }
  // 会社データ作成
  // CompanyRequestでバリデーション
  public function store(CompanyRequest $request)
  {
    if ($request->has('get_address')) {
        $formData = $request->request->all();
        $addressData = $this->company->getAddress($request['postal_code']);
        if (!$addressData) {
            return redirect('companies/create')->with('form_data', $formData);
        }
        return redirect('companies/create')->with(['prefecture_code' => $addressData['prefecture_code'], 'address' => $addressData['address'], 'form_data' => $formData]);
    }
    $this->company->store($request);
    return redirect('companies');
  }

  // 会社データ削除
  public function destroy(Request $request)
  {
    $this->company->softDelete($request['id']);
    return redirect('companies');
  }

  // 会社データ編集
  public function edit($id)
  {
    $detail = $this->company->getDetail($id);
    if (!$detail) {
      return redirect('companies');
    }
    return view('edit', compact('detail'));
  }

  // 会社データ更新
  public function update($id, CompanyRequest $request)
  {
    if ($request->has('get_address')) {
        $formData = $request->request->all();
        $addressData = $this->company->getAddress($request['postal_code']);
        if (!$addressData) {
            return redirect("companies/$id/edit")->with('form_data', $formData);
        }
        return redirect("companies/$id/edit")->with(['prefecture_code' => $addressData['prefecture_code'], 'address' => $addressData['address'], 'form_data' => $formData]);
    }
    $this->company->updateDetail($id, $request->updateAttributes());
    return redirect('companies');
  }

}
