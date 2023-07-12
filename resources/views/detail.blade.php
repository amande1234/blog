<html>

<head>
    <title>User Posts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./assets/style.css" />

</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
        <a class="navbar-brand" href="#">Custom Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>


            </ul>
            <form class="form-inline my-2 my-lg-0">
            <!-- <a href="/logout">Logout</a> -->
            </form>
        </div>
    </nav>
    <div id="main-content" class="blog-page">

        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-8 mx-auto col-md-12 left-box">
                    <div class="card single_post">
                        <div class="body">
                            <div class="img-post">
                                <img class="d-block img-fluid" src="{{ url('images/'.$post_detail->detail->image) }} alt="First slide">
                            </div>
                            <h3><a href="blog-details.html">{{$post_detail->title}}</a></h3>
                            <p>{{$post_detail->description}}</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2> {{'comments' .$total_comments}}</h2>
                        </div>
                        <div class="body">
                            @foreach($comment_detail as $key=>$value)
                            <ul class="comment-reply list-unstyled">
                                <li class="row clearfix">
                                    <div class="icon-box col-md-2 col-4"><img class="img-fluid img-thumbnail" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Awesome Image"></div>
                                    <div class="text-box col-md-10 col-8 p-l-0 p-r0">
                                        <h5 class="m-b-0">Gigi Hadid </h5>
                                        <p>{{$value['comment']}}</p>
                                        <ul class="list-inline">
                                            <li><a href="javascript:void(0);">Mar 09 2018</a></li>
                                            <li><a href="javascript:void(0);">Reply</a></li>
                                        </ul>
                                    </div>
                                </li>
                                
                            </ul>
                            @endforeach
                        </div>
                    </div>
                    <div class="card">

                        <div class="body">
                            <div class="comment-form">
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

                                <form class="row clearfix"  action ="/comment" method = "POST" enctype="multipart/form-data">

                                    <div class="col-sm-12">
                                        <div class="form-group">

                                            <textarea rows="4"  name = "comment" class="form-control no-resize" placeholder="Leave A Comment..."></textarea>
                                        </div>
                                        

                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="post_id" value="{{$post_detail->id}}">
                                        <button type="submit" class="btn btn-block btn-primary">SUBMIT</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
        <div class="container text-center">
            <small>Copyright &copy; Panckaj Sood</small>
        </div>
    </footer>
</body>

</html>