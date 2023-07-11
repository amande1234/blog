<?php

// print_r ($contact['image']);die;
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Kindly post</title>
  </head>


<body>
@if($errors->any())
    <div class="alert alert-danger">
    @foreach($errors->all() as $key => $value)
        <p class="text-center">{{$value}}</p>
    @endforeach
    </div>
    @endif
    
    @if($success=session('success'))
<div class="alert alert-success">
<p class="text-center">{{$success}}</p>
</div>
@endif
@if($error=session('error'))
<div class="alert alert-danger">
<p class="text-center">{{$error}}</p>
</div>
@endif

<div class="jumbotron container">

<div class="panel panel-default">
  <div class="panel-heading"><h3 class="text-center">Post</h3></div>
  <div class="panel-body">



<form action ="/post" method = "POST" enctype="multipart/form-data">

<div class="form-group" >
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control"  name="title"  id="exampleInputEmail1" aria-describedby="emailHelp" >
     </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea class="form-control"  name="description"  id="exampleInputPassword1">
    </textarea>
  </div>  
  <label for="description">Post Status:</label>

<select name="status" id="status">
  <option value="0">Draft</option>
  <option value="1">Publish</option>
  </select>
  <div class="form-group">
    <label for="exampleInputPassword1">Post Tags</label>
    <textarea class="form-control"  name="post_tags"  id="exampleInputPassword1">
    </textarea>
    <label for="description">Post Type:</label>

<select name="post_type" id="post_type">
  <option value="entertainment">Entertainment</option>
  <option value="news">News</option>
  <option value="sports">Sports</option>
  <option value="tech">Tech</option>
  </select>
  </div>  
  <div class="form-group">
    <label for="exampleInputPassword1">Image</label>
    <input type="file" class="form-control" name="image"  id="exampleInputPassword1">
  </div>

    <input type="hidden" name="_token" value="{{csrf_token()}}">
  <button type="submit" class="btn btn-primary">Post</button>
</form>
</div>
</div>


</div>


</body>
</html>