<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Str;
use Validator;
class registerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'name' => ['required'],
                 'email' => ['required'],
                 'password' => 'required',
                 'phone' => 'required',
               
            ]);
            
             
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => "Something's Went Wrong!",
                    "required_parametres" => $validator->errors()
                ]);
                
            }
            $name = $request->name;
            $email = $request->email;
            $password = bcrypt($request->password);
            $phone = $request->phone;
            $token =  uniqid().Str::random(51);

            $user = User::where('email',$email)->first();
            if($user)
            {
                
               return response()->json([
                    'message' => 'User Already Exits',
                    'status' => false
                    ]);
            }
            else{
                $user = new User();
                $user->name = $name;
                $user->email = $email;
                $user->password = $password;
                $user->phone = $phone;
                $user->token = $token;
                $user->save();
                
               return response()->json([
                    'message' => 'your account has been registered',
                    'status' => true
                    ]);
            }



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
