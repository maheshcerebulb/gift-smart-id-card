<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleSchedulerSetting;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Validation\Rule;
use Flash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Role::select('*'))
            ->addColumn('action', 'company-action')
            ->addColumn('action', function($row){
                // $btn = '<a class="btn-default  edit-role edit_form" data-path="'.route('role.edit', ['role' => $row->id]).'"> <button><i class="fa fa-edit"></i></button> </a>';
                $btn = '';
                // if(Auth::user()->can('edit.role')){
                    $btn = $btn.'<a class="edit-role edit_form btn btn-sm btn-success btn-icon mr-1 white" data-path="'.route('role.edit', ['role' => $row->id]).'" data-name="'.$row->name.'" data-id='.$row->id.' title="Edit"> <i class="fa fa-edit fa-1x"></i> </a>';
                // }
                // $btn = $btn.'<button type="submit" class=" btn-danger delete-role" data-id="'.$row->id.'"><i class="fa fa-trash-o"></i>';
                // if(Auth::user()->can('delete.role')){
                    $btn = $btn.'<a class="btn btn-sm btn-icon btn-danger mr-1 white delete-role" data-id="'.$row->id.'" title="Delete"> <i class="fa fa-trash fa-1x"></i> </a>';
                // }
                return $btn;
            })
            ->addIndexColumn()
            ->make(true);
        }
        $allPermission = Permission::all();
        $groupPermission = $allPermission->groupBy('module');
        return view('role.index', ['role' => new Role(), 'allPermission' => $allPermission, 'groupPermission' => $groupPermission]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allPermission = Permission::all();
        $groupPermission = $allPermission->groupBy('module');
        return view('role.create', ['role' => new Role(), 'allPermission' => $allPermission, 'groupPermission' => $groupPermission]);
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
        // dd($inputData);

        $permission_data=$inputData['permission_data'];
        $permission_module=$inputData['permission_module'];

        $request->validate([
            'name' => ['required',
                        Rule::unique('roles')->where(function ($query) use ($request){
                            return $query->where('guard_name', $request['guard_name']);
                        })
                    ],
            'guard_name' => 'required|max:255'
        ]);
        $role = Role::create(['name' => $inputData['name'], 'guard_name' => $inputData['guard_name']]);

        if(empty($role)){
            // $this->flashRepository->setFlashSession('alert-danger', 'Role not created.');
            return redirect()->route('role.index');
        }

        if($request->has('permission_data') && $role){
            $role->syncPermissions($inputData['permission_data']);
        }

        // $this->flashRepository->setFlashSession('alert-success', 'Role created successfully.');

        return redirect()->route('role.index');
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
    public function edit(Role $role)
    {
        if(empty($role)){
            // $this->flashRepository->setFlashSession('alert-danger', 'Role not found.');
            return view('role.index');
        }

        $allPermission = Permission::all();
        // $roleScheduler = RoleSchedulerSetting::all();, 'roleScheduler' => $roleScheduler
        $groupPermission = $allPermission->groupBy('module');
        return view('role.create', ['role' => $role, 'allPermission' => $allPermission, 'groupPermission' => $groupPermission]);
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
        $role = Role::find($id);
        if(empty($role)){
            // $this->flashRepository->setFlashSession('alert-danger', 'Role not found.');
            return redirect()->route('role.index');
        }
        $inputData = $request->all();

        $permission_data=$inputData['permission_data'];
        $permission_module=$inputData['permission_module'];

        $request->validate([
            'name' => ['required',
                        Rule::unique('roles')->ignore($id)->where(function ($query) use ($request){
                            return $query->where('guard_name', $request['guard_name']);
                        })],
            'guard_name' => 'required|max:255'
        ]);

        $role->update(['name' => $request->name, 'guard_name' => $request->guard_name]);

        $permission_data = $request->get('permission_data');
        $role->syncPermissions($permission_data);

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $roleDelete = Role::find($request->id)->delete();
        if($roleDelete)
            return response()->json(['msg' => 'Role deleted successfully!']);

        return response()->json(['msg' => 'Something went wrong, Please try again'],500);
    }
}
