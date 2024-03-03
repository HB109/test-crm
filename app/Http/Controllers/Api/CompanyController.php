<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= Company::all();
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
          'name' => 'required|max:255',
          'email' => 'email',
          'website' => 'url',
          'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100|max:2048',
        ]);

        if($validator ->fails()){
            return response()->json([
                'status'=>422,
                'message'=>$validator->messages()
            ],422);
        }else{
            $arr = [
                'name' => request('name'),
                'email' => request('email'),
                'website' => request('website')
            ];
            if($request->hasFile('logo')){
                $file = $request->file('logo');
                $filename = $file->getClientOriginalName();
                $file->storeAs('public/',$filename);
                // return redirect('/uploadfile');
                $arr['logo'] = $filename;
            }

            Company::create($arr);
            return response()->json([
                'status'=>200,
                'message'=>'Company created successfully.'
            ]);            
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data= Company::with('employees')->find($id);

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
