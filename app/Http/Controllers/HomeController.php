<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view('home');
    }

    public function getdata(){
        $todo = Todo::all();
        return $todo;
    }

    public function savedata(Request $request){
        Todo::updateOrCreate(['todo_id' => $request->id],
        ['todo_title' => $request->title]);
    }

    public function editdata(Request $request){
        $todo = Todo::where(['todo_id'=>$request->id])->first();
        return $todo;
    }

    public function deletedata(Request $request){
        $todo = Todo::where(['todo_id'=>$request->id])->first();
        $todo->delete();
        $result = "success";
        return $result;
    }
}
