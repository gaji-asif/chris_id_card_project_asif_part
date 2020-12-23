<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ErpRole;
use App\ErpModule;
use App\Erp_role_permissions;

class ErpRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = ErpRole::all();
        return view('backEnd.roles.create', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_name'=>'required'
        ]);
            
        $role = new ErpRole();
        $role->role_name = $request->get('role_name');

        $role->save();
        return redirect('/role')->with('message-success', 'Role has been added');
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
    public function edit($id)
    {
        $role = ErpRole::find($id);
        return view('backEnd.roles.edit', compact('role'));
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
        $request->validate([
            'role_name'=>'required'
        ]);
            
        $role = ErpRole::find($id);
        $role->role_name = $request->get('role_name');

        $role->save();
        return redirect('/role')->with('message-success', 'Role has been updated');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
    public function deleteRoleView($id){
        $module = 'deleteRole';
         return view('backEnd.showDeleteModal', compact('id','module'));
    }

    public function deleteRole($id){
        $result = ErpRole::destroy($id);
        if($result){
            return redirect()->back()->with('message-success-delete', 'Role has been deleted successfully');
        }else{
            return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        }
    }

    public function assignPermission($role_id){
        $role = ErpRole::find($role_id);
        $modules = ErpModule::where('active_status', 1)->get();
        $role_permissions = Erp_role_permissions::where('role_id', $role_id)->get();
        $already_assigned = [];
        foreach($role_permissions as $role_permission){
            $already_assigned[] = $role_permission->module_link_id;
        }
        return view('backEnd.roles.assignPermission', compact('role', 'modules', 'already_assigned'));
    }

    public function rolePermissionStore(Request $request){
        Erp_role_permissions::where('role_id', $request->role_id)->delete();

        if(isset($request->permissions)){
            foreach($request->permissions as $permission){
                $role_permission = new Erp_role_permissions();
                $role_permission->role_id = $request->role_id;
                $role_permission->module_link_id = $permission;
                $role_permission->save();
            }
        }

        return redirect('role')->with('message-success-assign-role', 'Role permission has been assigned successfully');
    }
}
