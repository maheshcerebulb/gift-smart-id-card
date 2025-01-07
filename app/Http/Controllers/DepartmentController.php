<?php
namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Http\Request;
class DepartmentController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Department::select('*'))
            ->addColumn('action', function($row){
                $btn = '';
                $btn = $btn.'<a class="edit-department edit_form btn btn-icon btn-success mr-1 white" data-path="'.route('department.edit', ['department' => $row->id]).'" data-name="'.$row->name.'" data-id='.$row->id.' title="Edit"> <i class="fa fa-edit"></i> </a>';
                $btn = $btn.'<a class="btn btn-icon btn-danger mr-1 white delete-department" data-id="'.$row->id.'" title="Delete"> <i class="fa fa-trash"></i> </a>';
                return $btn;
            })
            ->addIndexColumn()
            ->make(true);
        }
        return view('department.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create', ['department' => new Department()]);
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
        ]);
        $department = Department::create(['name' => $inputData['name']]);
        if(empty($department)){
            return redirect()->route('department.index');
        }
        return redirect()->route('department.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }
  /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        if(empty($department)){
           return view('department.index');
        }
        return view('department.create', ['department' => $department]);
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
        $department = Department::find($id);
        if(empty($department)){
            return redirect()->route('department.index');
        }
        $inputData = $request->all();
        $request->validate([
            'name' => 'required',
        ]);
        $department->update(['name' => $inputData['name']]);
        return redirect()->route('department.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $companyDelete = Department::find($request->id)->delete();
        if($companyDelete)
        {
            return response()->json(['msg' => 'Department deleted successfully!']);
        }
        return response()->json(['msg' => 'Something went wrong, Please try again'],500);
    }
}
