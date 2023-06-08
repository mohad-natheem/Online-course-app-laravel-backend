<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //returning all the courses
    public function courseList(){
    //select method is used to select the required fiels and get method is used to return the selected data fields
    try{
    $result = Course::select('name','thumbnail','lesson_num','price','id')->get();

    return response()->json([
        'code'=>200,
        'msg'=>'Courses List retrieved successfully',
        'data'=>$result
    ],200);
   }catch(\Throwable $th){
    return response()->json([
        'code'=>500,
        'msg'=>'Unable to retrive data from the server',
        'data'=>$th->getMessage()
    ],500);
   }

    //
}
}
