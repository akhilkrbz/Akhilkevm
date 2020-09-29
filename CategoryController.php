<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        if($categories->count() > 0){
        	$data = [
        				'status' => 200,
        				'message' => $categories
        			];
        }
        else{
        	$data = [
        				'status' => 422,
        				'message' => 'No Categories'
        			];
        }
        return response()->json($data,$data['status']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'bail|required|unique:categories,name', 'image' => 'required|image']);

        if($validator->fails()){
        	$error = $validator->errors()->first();
        	$data = [
        				'status' => 422,
        				'message' => $error
        			];
        }
        else{
        	$name = $request->name;
        	$image = $request->file('image');
        	// $image->store();
        	$path = 'storage/Uploads';
        	
        	$image->move($path,$image->getClientOriginalName());
        	Category::create(['name' => $name,'image' => $image->getClientOriginalName()]);
        	$data = [
        				'status' => 200,
        				'message' => 'Category Added Successfully'
        			];
        }


        return response()->json($data,$data['status']);
        
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
        $validator = Validator::make($request->all(), ['name' => 'bail|required|unique:categories,name', 'image' => 'required|image']);

        if($validator->fails()){
        	$error = $validator->errors()->first();
        	$data = [
        				'status' => 422,
        				'message' => $error
        			];
        }
        else{
        	$name = $request->name;
        	$image = $request->file('image');
        	// $image->store();
        	$path = 'storage/Uploads';
        	
        	$image->move($path,$image->getClientOriginalName());
        	Category::update(['name' => $name,'image' => $image->getClientOriginalName()]);
        	$data = [
        				'status' => 200,
        				'message' => 'Category Added Successfully'
        			];
        }


        return response()->json($data,$data['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = Category::where('id',$id)->delete();
        if($query){
        	$data = [
        				'status' => 200,
        				'message' => 'Category Deleted Successfully'
        			];
        }
        else{
        	$data = [
        				'status' => 422,
        				'message' => 'Something Went Wrong'
        			];
        }
        return response()->json($data,$data['status']);
    }
}
