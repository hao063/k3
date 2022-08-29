@extends('frontend.layouts.frontend')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <!-- ============= Post Content Area Start ============= -->
            <div class="col-12 col-lg-8">
                <div class="post-content-area mb-50">
                    <!-- Catagory Area -->
                    <div class="world-catagory-area">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="title">Tin tức</li>

                            <li class="nav-item">
                                <a class="nav-link active" id="tab1" data-toggle="tab" href="#world-tab-1" role="tab" aria-controls="world-tab-1" aria-selected="true">All</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="world-tab-1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="world-catagory-slider owl-carousel wow fadeInUpBig" data-wow-delay="0.1s">
                                            @foreach ($data as $item)
                                                    <div class="single-blog-post">
                                                        <div class="post-thumbnail">
                                                            <img src="{{$item['img']}}" alt="">
                                                            <div class="post-cta"><a href="#">travel</a></div>
                                                        </div>
                                                        <div class="post-content">
                                                            <a href="{{route('detail', $item['id'])}}" class="headline">
                                                                <h5>{{$item['title']}}</h5>
                                                            </a>
                                                            <p>{{$item['content']}}</p>
                                                            <div class="post-meta">
                                                                <p><a class="post-author">{{$item['user']['name']}}</a> on <a class="post-date">{{date('d-m-Y H:i:s', strtotime($item['created_at']))}}</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        @foreach($data as $item)
                                                <div class="single-blog-post post-style-2 d-flex align-items-center wow fadeInUpBig" data-wow-delay="0.2s">
                                                    <div class="post-thumbnail">
                                                        <img src="{{$item['img']}}" alt="">
                                                    </div>
                                                    <div class="post-content">
                                                        <a href="{{route('detail', $item['id'])}}" class="headline">
                                                            <h5>{{$item['title']}}</h5>
                                                        </a>
                                                        <div class="post-meta">
                                                            <p><a class="post-author">{{$item['user']['name']}}</a> on <a class="post-date">{{date('d-m-Y H:i:s', strtotime($item['created_at']))}}</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ========== Sidebar Area ========== -->
            <div class="col-12 col-md-8 col-lg-4">
                <div class="post-sidebar-area wow fadeInUpBig" data-wow-delay="0.2s">
                    <!-- Widget Area -->
                    <div class="sidebar-widget-area">
                        <h5 class="title">Demo</h5>
                        <div class="widget-content">
                            <p>The mango is perfect in that it is always yellow and if it’s not, I don’t want to hear about it. The mango’s only flaw, and it’s a minor one, is the effort it sometimes takes to undress the mango, carve it up in a way that makes sense, and find its way to the mouth.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection