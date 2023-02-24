<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function getCompanies(Request $request) {
      $name = $request['name'];
      $company = new Company;
      $companies = $company->getData($name);
      return view('company', compact('companies', 'name'));
    }
    
    public function store(Request $request) {
      $company = new Company;
      $company->create($request);
      return redirect('companies');
    }

    public function delete(Request $request) {
      $company = new Company;
      $company->softDelete($request);
      return redirect('companies');
    }

    public function edit($id) {
      $company = new Company;
      $detail = $company->getDetail($id);
      return view('edit', compact('detail'));
    }

    public function update($id, Request $request) {
      $company = new Company;
      $company->updateDetail($id, $request);
      return redirect('companies');
    }
    
}
