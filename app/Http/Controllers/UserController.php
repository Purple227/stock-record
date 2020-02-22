<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user_login = true;
        }else {
            $user_login = false;
        }
        return response()->json($user_login);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->password, $hashedPassword)) {
            $bridge = true;
        } else {
            $bridge = false;
        }

        return response()->json($bridge);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail(Auth::id());
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail(Auth::id());
        return response()->json($user);
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

        $user = User::findOrFail(Auth::id());

        $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:20', 'min:3'],
        'title' => ['required', 'string', 'max:20', 'min:3'],
        'description' => ['required', 'string', 'max:400', 'min:150'],
        ]);

        if ( $request->hasFile('file') ) {
            Storage::deleteDirectory('public/profile');
            $path = Storage::disk('public')->putFile('profile',$request->file('file'));
            $user->image = $path;
        }
        
        $user->name = $request->name;
        $user->title = $request->title;
        $user->description = $request->description;
        $user->save();
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
}
