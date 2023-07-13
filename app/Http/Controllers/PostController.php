<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;



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
        $total_comments = count($comment_detail);
        $is_author = false;
        $author_id = Post::find($id)->detail->author_id;
        $loggedinid= auth()->user()->id;
        if($author_id==$loggedinid){
            $is_author=true;
        }
    




        return view('detail', ['post_detail' => $post_detail, 'comment_detail' => $comment_detail, 'total_comments' => $total_comments, 'is_author'=>$is_author]);
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
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }
    public function delete(Request $request,$id){
        $post=comment::find($id);
        $post->delete();
        return back();
    }
    public function filter(Request $request)
    {
// dd($_REQUEST);
        unset($_REQUEST['_token']);
        $filter = [];
        foreach ($_REQUEST as $key => $value) {

            if (!empty($value)) {

                $filter[$key] = $value;
            }
        }

        $id = auth()->user()->id;

        $posts_list = [];


        if (count($filter) > 0) {

            $filtered_data = Detail::with('post')->where($filter)->get();
        } else {
            $filtered_data = Detail::with('post')->get();
        }

        if ($filtered_data) {

            foreach ($filtered_data as $value) {
                $posts_list[$value->post_id] = [

                    'author_name' => User::find($value->author_id)->name,
                    'post_type' => $value->post_type,
                    'post_title' => $value->post->title,
                    'post_description' => $value->post->description,
                    'post_image' => $value->image,
                    'post_id' => $value->post_id,

                ];
            }



        }



        return view('blog', ['posts_list' => $posts_list]);
    }
}
