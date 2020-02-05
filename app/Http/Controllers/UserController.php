<?php

namespace App\Http\Controllers;

use App\Role;
use App\Traits\UserTrait;
use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use UserTrait;

    public function index()
    {
        return view('dashboard.users.index');
    }

    public function store(Request $request)
    {
        $this->storeFormValid($request);
        $user = new User();
        $response = $this->createUser($user,$request);

        if ($response){
            return response()->json(setMessage('User Created', 200));
        }
        else{
            return response()->json(setMessage('User Can not Created'));
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        if(!empty($user)){
            $roleId = ($user->roles()->exists()) ? $user->roles[0]->id : 0;
            return response()->json(['user' => $user, 'role_id' => $roleId]);
        }
        return response()->json(setMessage('User not Found'));
    }


    
    public function update(Request $request)
    {
        $this->updateFormValid($request);
        
        $user = User::find($request->user_id);
        if(!empty($user)){
            $response = $this->createUser($user,$request,'update');
            if($response)
                return response()->json(setMessage('User Updated', 200));
        }else{
            return response()->json(setMessage('User Can not be Updated'));
        }
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if(!empty($user)){
            if($user->delete())
                return response()->json(setMessage('User Deleted', 200));
        }else{
            return response()->json(setMessage('Oops! Something Went Wrong.'));
        }
    }

    public function getUsers(Request $request)
    {
        $users = User::query();
        $len = $request->itemPerPage;
        if ($request->search) {
            $searchValue = $request->search;
            $users = $users->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%');
            });
        }
        if ((!empty($request->column)) && (!empty($request->dir))) {
            $users = $users->orderBy($request->column, $request->dir);
        }else{
            $users = $users->latest();
         }
        $users = $users->paginate($len);
        $create = checkPermission('create-users');
        $edit = checkPermission('update-users');
        $delete = checkPermission('update-users');
        return response()->json(['users' => $users,'user_create' => $create, 'user_edit' => $edit, 'user_delete' => $delete]);
    }

    public function allRoles(){
        $roles = Role::get();
        return response()->json(['roles' => $roles]);
    }
}
