<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use App\Models\Order;
use App\Mail\NewAccountCreationNotification;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::all();
       return view('backend.Role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Permission::create(['name'=>'customer dashboard access']);
    $permissions=Permission::all();
       return view('backend.Role.create',compact('permissions'));
    //   $permission = Permission::create(['name' => 'category add']);
    //    $permission = Permission::create(['name' => 'category view']);
    //    $permission = Permission::create(['name' => 'category edit']);
    //    $permission = Permission::create(['name' => 'category delete']);
       //echo "added";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $role = Role::create(['name' => $request->role_name]);
        $role->givePermissionTo($request->permissions);
        return back();
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
    {$role=Role::find($id);
        $permissions=Permission::all();
        return view('backend.Role.edit',compact('role','permissions'));
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
        $role=Role::find($id);
        $role->syncPermissions($request->permissions);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function assignuser()
    {$roles=Role::all();
        $users=User::all();
        return view('backend.Role.assignuser',compact('roles','users'));
    }
    public function assignuserstore(Request $request)
    {
      $user=User::find($request->id);
      $user->assignRole($request->name);
      return back();
    }
    public function adduser()
    {$roles=Role::all();
        return view('backend.Role.adduser',compact('roles'));
    }
    function postuser(Request $request)
    {$randompassword=Str::random(10);
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
       
        $user->password=bcrypt($randompassword);
    
        $user->save();
        $user->assignRole($request->role_name);
        Mail::to($request->email)->send(new NewAccountCreationNotification($randompassword));
    }
}
