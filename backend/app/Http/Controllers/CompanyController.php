<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index(request $request){
        return Company::selectCompany($request);
    }

    public function create(request $request){
        $company            = new Company;
        $company->comp_name = $request->comp_name;
        $company->address   = $request->address;
        $company->phone     = $request->phone;
        $company->save();

        return response()->json([
            'code' => '200',
            'message' => 'Successfully create company'
        ]);
    }

    public function update(request $request, $id){
        $comp_name  = $request->comp_name;
        $address    = $request->address;
        $phone      = $request->phone;

        $company            = Company::find($id);
        $company->comp_name = $comp_name;
        $company->address   = $address;
        $company->phone     = $phone;
        $company->save();

        return response()->json([
            'code' => '200',
            'message' => 'Successfully update company',
            'company' => $company
        ]);
    }

    public function delete($id){
        $company = Company::find($id);
        $company->delete();

        return response()->json([
            'code' => '200',
            'message' => 'Successfully delete company'
        ]);
    }
}
