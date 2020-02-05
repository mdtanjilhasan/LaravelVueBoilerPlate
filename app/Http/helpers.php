<?php


use Illuminate\Support\Facades\Session;

function getUserRole($user)
{
    $type = "Normal";
    foreach ($user->roles as $role) {
        $type = $role->name;
        break;
    }

    return $type;
}

function checkPermission($permission)
{
    return \Laratrust::can($permission);
}

function setSuccessMessage($message)
{
    Session::flash('success',$message);
}

function setFailMessage($message)
{
    Session::flash('fail',$message);
}

function setMessage($message, $code = 400){
    if($code == 200)
        return ['message' => $message,'type' => 'success'];
        
    return ['message' => $message,'type' => 'danger'];
}