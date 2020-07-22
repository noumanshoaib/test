<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\order;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusUpdate;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminAuth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        return response()->json([
            'data' => order::with(['product','user'])->get(),
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'data' => order::find($id)->with(['product','user'])->first(),
            'status' => true
            ]);
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

    public function updateStatus(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'status' => ['required'],
            'order_id' => 'required',

        ]);
        
         
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Something's Went Wrong!",
                "required_parametres" => $validator->errors()
            ]);
        }
        $status = $request->status;
        $id = $request->order_id;

        $order = order::where('id',$id)->with('user')->first();
        if($order)
        {
            $order->status = $status;
            $order->save();
            Mail::to($order->user->email)->send(new OrderStatusUpdate($order));
        }
        else{
            return response()->json([
                'data' => null,
                'message' => 'Order ID not found',
                'status' => false
                ]);
        }

        return response()->json([
            'data' => $order,
            'message' => 'Successfully updated',
            'status' => true
            ]);
    }
}
