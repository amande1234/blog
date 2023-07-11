<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail;
use App\Models\Post;


class PostController extends Controller
{
    public function view(Request $request)
    {
        return view('post');
    }
    public function submit(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:post',
            'description' => 'required',
            'status' => 'required',
            'post_tags'=>'required',
            'post_type' => 'required|min:4|',
            'image' => 'required',


        ]);
        $image = time() . '.' . $request->file('image')->extension();

        $request->file('image')->move(public_path('images'), $image);
        $title= $request->title;
        $description=$request->description;
        $status=$request->status;
        $tags=$request->post_tags;
        $type=$request->post_type;

        $post = new post;

        $post->title = $title;
        $post->description = $description;
      

        if ($post->save()) {


            $detail= new Detail;

            $detail->author_id = auth()->user()->id;
            $detail->post_id = $post->id;
            $detail->post_status= $status;
            $detail->post_tags=$tags;
            $detail->post_type=$type;

            $detail->image = $image;
           if($detail->save()){
            $request->session()->flash('success', 'data submitted successfully');
            
           }
           

        } else {
            $request->session()->flash('error', 'data not submitted successfully');
        }

        return back();



    }
    public function detail(Request $request,$id){
        $post_detail = Post::find($id);

       
        return view('detail',['post_detail'=>$post_detail]);
        // dd ($detail);  

    }


    }
     

