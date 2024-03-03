<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= Employee::all();
        return ['result'=>$data];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            return response()->json([
                'status'=>422,
                'message'=>$validator->messages()
            ],422);
        }else{
             
            Employee::create($request->all());
            return response()->json([
                'status'=>200,
                'message'=>'Employee created successfully.'
            ]);            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data= Employee::find($id);
        return ['result'=>$data];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
