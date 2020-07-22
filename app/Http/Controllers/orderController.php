<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use Illuminate\Http\Request;
use App\order;
use App\User;
use Validator;
use Illuminate\Support\Facades\Mail;
class orderController extends Controller
{

    public function __construct()
    {
        $this->middleware('userAuth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json([
            'data' => $request->user->order()->With('product')->get(),
            'status' => true
            ]);

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
        $validator = Validator::make($request->all(), [
            'product_id' => ['required'],
             'address' => ['required'],
           
        ]);
        
         
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Something's Went Wrong!",
                "required_parametres" => $validator->errors()
            ]);
            
        }
        
        $product_id = $request->product_id;
        $order = new order();
        $order->product_id = $product_id;
        $order->address = $request->address;
        $order->user_id = $request->user->id;
        $order->save();

        $email = $request->user->email;
        

        Mail::to($email)->send(new OrderConfirmation($order));
       
        return response()->json([
            'data' => null,
            'status' => true,
            'message'=>'Your order has been placed Successfully',
            ]);
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
