<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function UserView(){
        // $allData = User::all();
        $data['allData'] = User::all();
        return view('backend.user.viewUser', $data);
    }

    public function UserAdd(){
        return view('backend.user.addUser');
    }

    public function UserStore(Request $request){
        $validateData = $request->validate([
        'email' => 'required|unique:users',
        'name' => 'required',
        ]);

        $data = new User();
        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        $notification = array(
            'message' => 'เพิ่มผู้ใช้งานสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    }

    public function UserEdit($id){
        $editData = User::find($id);
        return view('backend.user.editUser', compact('editData'));
    }

    public function UserUpdate(Request $request, $id)
    {
        $data = User::find($id);
        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        $notification = array(
            'message' => 'ปรับปรุงข้อมูลผู้ใช้งานสำเร็จ',
            'alert-type' => 'info'
        );

        return redirect()->route('user.view')->with($notification);

    }

    public function UserDelete($id){
        $user = User::find($id);
        $user->delete();

        $notification = array(
            'message' => 'ลบข้อมูลผู้ใช้งานสำเร็จ',
            'alert-type' => 'danger'
        );

        return redirect()->route('user.view')->with($notification);


    }
}
