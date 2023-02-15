<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/avatars/';
    private $user;
    private $product;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show()
    {
        $user = $this->user->findOrFail(Auth::user()->id);
        return view('users.show')->with('user', $user);
    }

    public function edit()
    {
        $user = $this->user->findOrFail(Auth::user()->id);
        return view('users.edit')->with('user', $user);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'    => 'required|min:1|max:50',
            'email'   => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            'avatar'  => 'mimes:jpg,png,jpeg,gif|max:1048'
        ]);

        $user        = $this->user->findOrFail(Auth::user()->id);
        $user->name  = $request->name;
        $user->email = $request->email;

        if($request->avatar){
            if($user->avatar){
                $this->deleteAvatar($user->avatar);
            }
            $user->avatar = $this->saveAvatar($request);
        }

        $user->save();

        return view('users.show')
                ->with('user',$user);
    }

    private function saveAvatar($request){

        $avatar_name = time() . "." . $request->avatar->extension();

        $request->avatar->storeAs(self::LOCAL_STORAGE_FOLDER, $avatar_name);

        return $avatar_name;
    }

    private function deleteAvatar($avatar_name){
        $avatar_path = self::LOCAL_STORAGE_FOLDER . $avatar_name;

        if(Storage::disk('local')->exists($avatar_path)){
            Storage::disk('local')->delete($avatar_path);
        }
    }

    public function destroy($id)
    {
        $user = $this->user->findOrFail($id);
            $this->deleteAvatar($user->avatar);
            
            $this->user->destroy($id);
        
            return redirect()->route('logout');
    }
}
