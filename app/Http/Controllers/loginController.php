<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;
class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
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
        try{
        $validator = Validator::make($request->all(), [
            'password' => ['required'],
             'email' => ['required'],
           
        ]);
        
         
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Something's Went Wrong!",
                "required_parametres" => $validator->errors()
            ]);
            
        }
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email',$email)->first();

        if(!$user)
        {
            return response()->json([
                'status' => false,
                'message' => 'Username or password is invalid',
            ]);
        }

        if (Hash::check($password, $user->password)) {


            return response()->json([
                'status' => true,
                'data' => array('token' => $user->token),
                'message' => 'Successfully Authenticated',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Username or password is invalid',
        ]);
        }
        catch(\Exception $e)
        {
            
            

            return response()->json([
                'data' => array('error'=>$e->getMessage()),
                'message'=> 'something is wrong',
                'status' => false
                ]);
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
        //
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
        //
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
