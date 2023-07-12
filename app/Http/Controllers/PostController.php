<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail;
use App\Models\Post;
use App\Models\Comment;


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
            'post_tags' => 'required',
            'post_type' => 'required|min:4|',
            'image' => 'required',


        ]);
        $image = time() . '.' . $request->file('image')->extension();

        $request->file('image')->move(public_path('images'), $image);
        $title = $request->title;
        $description = $request->description;
        $status = $request->status;
        $tags = $request->post_tags;
        $type = $request->post_type;

        $post = new post;

        $post->title = $title;
        $post->description = $description;


        if ($post->save()) {


            $detail = new Detail;

            $detail->author_id = auth()->user()->id;
            $detail->post_id = $post->id;
            $detail->post_status = $status;
            $detail->post_tags = $tags;
            $detail->post_type = $type;

            $detail->image = $image;
            if ($detail->save()) {
                $request->session()->flash('success', 'data submitted successfully');
            }
        } else {
            $request->session()->flash('error', 'data not submitted successfully');
        }

        return back();
    }
    public function detail(Request $request, $id)
    {
        $post_detail = Post::find($id);
        $comment_detail = Post::find($id)->comment_detail;
        $total_comments=count($comment_detail);
// dd($comment_detail);


        return view('detail', ['post_detail' => $post_detail, 'comment_detail' => $comment_detail,'total_comments'=>$total_comments]);
        // dd ($detail);  

    }
    public function comment(Request $request)
    {

        $request->validate([
            'comment' => 'required',
        ]);


        $user_id = auth()->user()->id;

        $post_id = json_decode($request->post_id);


        $comment = $request->comment;

        $Comment = new Comment;

        $Comment->comment = $comment;
        $Comment->post_id = $post_id;
        $Comment->user_id = $user_id;

        if ($Comment->save()) {
            $request->session()->flash('success', 'commented successfully');
        } else {
            $request->session()->flash('error', ' sorry no comment');
        }

        return back();
    }
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }
}
