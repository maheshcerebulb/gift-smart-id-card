<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Company::select('*'))
            ->addColumn('action', function($row){
                $btn = '';
                $btn = $btn.'<a class="edit-company edit_form btn btn-icon btn-success mr-1 white" data-path="'.route('company.edit', ['company' => $row->id]).'" data-name="'.$row->name.'" data-id='.$row->id.' title="Edit"> <i class="fa fa-edit"></i> </a>';
                $btn = $btn.'<a class="btn btn-icon btn-danger mr-1 white delete-company" data-id="'.$row->id.'" title="Delete"> <i class="fa fa-trash"></i> </a>';
                return $btn;
            })
            ->addIndexColumn()
            ->make(true);
        }
        return view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create', ['company' => new Company()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputData = $request->all();
        $request->validate([
            'name' => 'required',
            'application_no' => 'required'
        ]);
        $company = Company::create(['name' => $inputData['name'], 'application_no' => $inputData['application_no']]);

        if(empty($company)){
            // $this->flashRepository->setFlashSession('alert-danger', 'company not created.');
            return redirect()->route('company.index');
        }
        // $this->flashRepository->setFlashSession('alert-success', 'Role created successfully.');

        return redirect()->route('company.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        if(empty($company)){
            // $this->flashRepository->setFlashSession('alert-danger', 'company not found.');
            return view('company.index');
        }

        return view('company.create', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        if(empty($company)){
            // $this->flashRepository->setFlashSession('alert-danger', 'Role not found.');
            return redirect()->route('company.index');
        }
        $inputData = $request->all();

        $request->validate([
            'name' => 'required',
            'application_no' => 'required'
        ]);

        $company->update(['name' => $inputData['name'], 'application_no' => $inputData['application_no']]);

        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $companyDelete = Company::find($request->id)->delete();
        if($companyDelete)
            return response()->json(['msg' => 'Company deleted successfully!']);

        return response()->json(['msg' => 'Something went wrong, Please try again'],500);
    }


}
