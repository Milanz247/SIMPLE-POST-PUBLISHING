<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function viewdashboard()
    {
       
        return view('dashboard');
        
    }
    public function Remove($id){
   
        Post::find($id)->delete();
      
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
    
    public function Savepost(Request $request)
    {

        // dd($request);
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ],[
            'title.required' => 'Input title ',
            'content.required' => 'Input content ',

        ]);
        $id=Auth::user()->id;
        Post::insert([

            'title'=> $request->title,
            'content'=> $request->content ,
            'user_id' =>$id,
            'created_at' =>Carbon::now(),
        ]);

        return redirect()->back();

    }//end methode

    public function fetchpost()
    {

        $id=Auth::user()->id;
        $post = Post::where('user_id',$id)->get();
        return response()->json([
            'post'=>$post,
        ]);
        
    }

    public function EditPost($id){
        // dd($id);
        $post = Post::findOrFail($id);
        return view('edit_post',compact('post'));
    }
  
    public function UpdatePost(Request $request)
    {
        $pid=$request->id;
        Post::findOrFail($pid)->update([

            'title'=> $request->title,
            'content'=> $request->content ,
            'created_at' =>Carbon::now(),

        ]);         
        return redirect()->route('home');
   }


    


   

}