<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\ErpRole;

class ErpUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = ErpRole::all();
        return view('backEnd.users.create', compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $roles = ErpRole::all();
        return view('backEnd.users.create', compact('users','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // get all uesr emails
        $all_user_email = User::get()->pluck('email');

        $request->validate([
            'first_name'=>'required',
            'last_name'=> 'required',
            'email'=> 'required',
            'role_id' => 'required',
            'password' => 'required'
        ]);

        //This foreach for checking if there are similar email address or not
        foreach ($all_user_email as $key => $value) {
            if( $value == $request->get('email') ) {
                return redirect('/user')->with('message-danger', 'Sorry this email already exists.');
            }
        }

        $user = new User();
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->name = $request->get('first_name') ." ". $request->get('last_name');
        $user->email = $request->get('email');
        $user->role_id = $request->get('role_id');
        $password = $request->get('password');
        $password_confirmation = $request->get('password_confirmation');

        if($password == $password_confirmation) {
            $user->password = Hash::make( $request->get('password') );
            $user->save();
            return redirect('/user')->with('message-success', 'User has been added');
        } else {
            return redirect('/user')->with('message-danger', 'Password does not match.');
        }

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
        $editData = User::find($id);
        $roles = ErpRole::all();
        return view('backEnd.users.edit', compact('editData', 'roles'));
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
        //get user hashed password
        $hashed_pass = User::find($id)->password;
        // get all uesr emails except this user id
        $all_user_email = User::where('id', '!=', $id)->pluck('email');
        
        $request->validate([
            'first_name'=>'required',
            'last_name'=> 'required',
            'email'=> 'required',
            'role_id' => 'required'
        ]);

        $user = User::find($id);
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->name = $request->get('first_name') ." ". $request->get('last_name');
        $user->email = $request->get('email');
        $user->role_id = $request->get('role_id');
        $previous_password = $request->get('previous_password');
        $password = $request->get('password');
        $password_confirmation = $request->get('password_confirmation');

        //This foreach for checking if there are similar email address or not
        foreach ($all_user_email as $key => $value) {
            if( $value == $request->get('email') ) {
                return redirect('/user/'.$id.'/edit')->with('message-danger', 'Sorry this email already exists.');
            }
        }

        // validate passwords for users
        if( $previous_password != '' && $password != '' && $password_confirmation != '') {
            if( $password == $password_confirmation ) {
                if( Hash::check( $previous_password, $hashed_pass) ) {
                    $user->password = Hash::make( $request->get('password') );
                    $user->save();
                    return redirect('/user')->with('message-success', 'User has been updated');
                } else {
                    return redirect('/user/'.$id.'/edit')->with('message-danger', 'Previous password does not match.');
                }
            } else {
                return redirect('/user/'.$id.'/edit')->with('message-danger', 'Password does not match.');
            }
        } else if( $previous_password == '' && $password == '' && $password_confirmation == '') {
            $user->password = $hashed_pass;
            $user->save();
            return redirect('/user')->with('message-success', 'User has been updated');
        } else {
            return redirect('/user/'.$id.'/edit')->with('message-danger', 'Check your password.');
        }

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
    public function deleteUserView($id){
        $module = 'deleteUser';
         return view('backEnd.showDeleteModal', compact('id','module'));
    }

    public function deleteUser($id){
        $result = User::destroy($id);
        if($result){
            return redirect()->back()->with('message-success-delete', 'User has been deleted successfully');
        }else{
            return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        }
    }

}
