<?php


namespace App\Traits;

use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait UserTrait
{
    protected function storeFormValid($request)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|numeric|min:1',
            'status' => 'required|numeric',
        ]);
    }

    protected function createUser($model,$request,$type = '')
    {
        DB::beginTransaction();
        try {
            $model->name = $request->name;
            $model->email = $request->email;
            $model->password = Hash::make(12345678);
            $model->status = $request->status;
            $model->save();
            $model->roles()->sync([$request->role]);
            if($type != 'update'){
                $profile = new Profile();
                $profile->user_id = $model->id;
                $profile->save();
            }            
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
    }

    protected function updateFormValid($request)
    {
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$request->user_id,
            'role' => 'required|numeric|min:1',
            'status' => 'required|numeric',
        ]);
    }
}
