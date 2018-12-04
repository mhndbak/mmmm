<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\ContactUS;



class ContactUSController extends Controller
{

    public function index()
    {
        return view('welcome',compact('tasks'));
    }

    public function store(Request $request)
    {
        $task= new ContactUS;
        $task->FirstName = $request->FirstName;
        $task->LastName = $request->LastName;
        $task->email = $request->email;
        $task->message = $request->message;
        $task->save();
        return redirect('/');
    }



    public function indexedit($id){
        DB::table('tasks')->where('id','=',$id)->get();
        return view('welcome',compact('tasks'));
    }
                
    public function update(Request $request , $id){
        DB::table('tasks')->where('id','=',$id)->update(
            [
                'FirstNam'=>$request->FirstName,
                'LastName'=>$request->LastName,
                'email'=>$request->email,
                'message'=>$request->message,
                'created_at'=>now(),
                'updated_at'=>now()
            ]);

        return redirect ('/welcome');
    }


    public function listview(){
        $tasks = DB::table('tasks')->get();
        return view('welcome',compact('tasks'));
    }

    public function destroy($id){
        DB::table('tasks')->where('id','=',$id)->delete();
        return redirect ('/welcome');
    }
    
}