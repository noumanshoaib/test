<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\product;
use Illuminate\Http\Request;
use Validator;
class ProductController extends Controller
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
            'status' => true,
            'data' => product::all()
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
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
             'category' => ['required'],
             'price' => ['required'],
             'description' => ['required'],
             'image' => 'required|max:10000|mimes:png,jpeg'
           
        ]);
        
         
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Something's Went Wrong!",
                "required_parametres" => $validator->errors()
            ]);
        }
        $name = $request->name;
        $category = $request->category;
        $price = $request->price;
        $description = $request->description;

        $uploadedFile = $request->file('image'); 

        $fileName = uniqid().$uploadedFile->getClientOriginalName();

        if ($uploadedFile->isValid()) {
            $uploadedFile->move(public_path('/images'), $fileName);
        }

        

        $product = new product();
        $product->name = $name;
        $product->price = $price;
        $product->description = $description;
        $product->category = $category;
        $product->image = $fileName;
        $product->save();


        return response()->json([
            'status' => true,
            'message' => "product successfully created",
            'data' => $product
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
