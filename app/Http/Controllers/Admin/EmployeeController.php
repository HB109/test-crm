<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use App\Models\Company;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $employee= Employee::with('company')->get();

        return view('employees.list', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $company = Company::get()->pluck("name", "id");
         return view('employees.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
          'first_name' => 'required|max:255',
          'last_name' => 'required|max:255',
          'email' => 'email',
          'phone' => 'digits:10',
        ]);

        if($validator ->fails()){
             return redirect()->back()->withErrors($validator); 
        }else{
             
            Employee::create($request->all());
            $msg = "Employee created successful! ";
            return redirect('employees')->with('msg', $msg);            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee= Employee::find($id);
        $company = Company::get()->pluck("name", "id");
        return view('employees.edit', compact('employee','company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(),[
          'first_name' => 'required|max:255',
          'last_name' => 'required|max:255',
          'email' => 'email',
          'phone' => 'digits:10',
        ]);

        if($validator ->fails()){
            return redirect()->back()->withErrors($validator);
        }else{
            $arr = [
                'first_name' => request('first_name'),
                'last_name' => request('last_name'),
                'email' => request('email'),
                'phone' => request('phone'),
                'company_id' => request('company_id')
            ];
             
            Employee::where('id', $id)->update($arr);
            $msg = "Employee updated successful! ";
            return redirect('employees')->with('msg', $msg);            
        }

            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employee::destroy($id);
        $msg = "Employee Deleted successful! ";
        return redirect('employees')->with('msg', $msg);
    }
}
