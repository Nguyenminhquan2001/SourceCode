<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function qluser(Request $req)
    {
        $user = User::all();
        return view('qluser.quanlyuser',compact('user'));
    }
    public function deleteuser($id){
     $user = User::where('id',$id)->delete();
     return redirect()->route('qluser')->withSuccess(' xóa thành công');
}
}