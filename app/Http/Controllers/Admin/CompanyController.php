<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailPostJob;
use Illuminate\Support\Facades\Bus;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company= Company::all();
        return view('companies.list', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('companies.create');
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
            return redirect()->back()->withErrors($validator); 
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
            $this->testSendEmailBulk();
            $msg = "Company created successful! ";
            return redirect('companies')->with('msg', $msg);            
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
        $company= Company::find($id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(),[
          'name' => 'required|max:255',
          'email' => 'email',
          'website' => 'url',
          'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100|max:2048',
        ]);

        if($validator ->fails()){
            return redirect()->back()->withErrors($validator); 
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
            $msg = "Company Updated successful! ";
            Company::where('id', $id)->update($arr);

            return redirect('companies')->with('msg', $msg);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::with('employees')->find($id);
        $employee = Employee::get()->pluck("company_id", "id")->toArray();

        if (in_array($id, $employee))
        {
            $msg = "Company id linked with employee so, first delete that employee! ";
        }
        else
        {
            Company::destroy($id);
            $msg = "Company Deleted successful! ";
        }
        
        return redirect('companies')->with('msg', $msg);
    }

    public function testSendEmailBulk(){
        $users = \App\Models\User::get();
        echo "<pre>";
        $data['email'] = [];
        foreach($users as $user){
            array_push($data['email'], $user->email);
        }
        // dd($user['email']);
        
        // $data['email'][] = 'martinhen737@gmail.com';
        // $data['email'][] = 'baghel083@gmail.com';
        // $data['email'][] = 'hemantbaghel083@gmail.com';
        // print_r($data);
        // print_r($arr);die('--------');
        $bus =Bus::dispatch(new SendEmailPostJob($data));
        
        // $this->dispatch(new App\Jobs\SendEmailJob($data));
        
        return true;
        // dd($data['email']);
        // dd('email sent');
    }
}
