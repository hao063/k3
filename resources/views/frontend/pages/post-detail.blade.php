@extends('frontend.layouts.frontend')

@section('main')
<div class="main-content-wrapper section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <!-- ============= Post Content Area ============= -->
            <div class="col-12">
                <div class="single-blog-content mb-100">
                    <!-- Post Meta -->
                    <!-- Post Content -->
                    <div class="post-content">
                        <div class="post-thumbnail">
                            <img src="{{$data['post-detail']['img']}}" alt="">
                        </div>
                        <!-- Post Content -->
                            <a  class="headline " style="margin-top: 20px">
                                <h5>{{$data['post-detail']['title']}}</h5>
                            </a>
                        <h6 class="" style="margin-top: 20px">{{$data['post-detail']['content']}}</h6>
                        <div class="post-meta second-part">
                            <p><a  class="post-author">{{$data['post-detail']['user']['name']}}</a> on <a  class="post-date">{{date('d-m-Y H:i:s', strtotime($data['post-detail']['created_at']))}}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============== Related Post ============== -->
        <div class="row">
            @foreach ($data['posts-orther'] as $item)
                
            <div class="col-12 col-md-6 col-lg-4">
                <!-- Single Blog Post -->
                <div class="single-blog-post">
                    <!-- Post Thumbnail -->
                    <div class="post-thumbnail">
                        <img src="{{$item['img']}}" alt="">
                        <!-- Catagory -->
                        <div class="post-cta"><a >travel</a></div>
                    </div>
                    <!-- Post Content -->
                    <div class="post-content">
                        <a href="{{route('detail', $item['id'])}}" class="headline">
                            <h5>{{$item['title']}}</h5>
                        </a>
                        <p>{{$item['content']}}</p>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <p><a  class="post-author">{{$item['user']['name']}}</a> on <a  class="post-date">{{date('d-m-Y H:i:s', strtotime($item['created_at']))}}</a></p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="row">
            @if(Auth::check())
            <div class="col-12 col-lg-8">
                <div class="post-a-comment-area mt-70">
                    <h5>Nguyen Hao</h5>
                    <!-- Contact Form -->
                    <form action="{{route('post.comment', ['id' => $data['post-detail']['id']])}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="group">
                                    <textarea name="content" id="message" required></textarea>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Enter your comment</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn world-btn">Post comment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif
            <div class="col-12 col-lg-8">
                <!-- Comment Area Start -->
                <div class="comment_area clearfix mt-70">
                    <ol>
                        <!-- Single Comment Area -->
                        @foreach ($data['comments'] as $item2)
                            <li class="single_comment_area">
                                <!-- Comment Content -->
                                <div class="comment-content">
                                    <!-- Comment Meta -->
                                    <div class="comment-meta d-flex align-items-center justify-content-between">
                                        <p><a  class="post-author">{{$item2['user']['name']}}</a> on <a  class="post-date">{{date('d-m-Y H:i:s', strtotime($item2['created_at']))}}</a></p>
                                        @if(Auth::id() == $item2['user_id'])
                                            <p>
                                                <a class="text-danger" href="{{route('delete.comment', ['id' => $item2['id']])}}">delete</a>
                                            </p>
                                        @endif
                                    </div>
                                    <p>
                                        {{$item2['content']}}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection