@extends('client.layout.layout')
@section('title', 'Homepage')
@section('body')
        <!--Breadcrumb section-->
        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <a href="{{route('homepage')}}"><i class="fa fa-home"></i>Home</a>
                            <span> Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          <!--Breadcrumb section end-->

   <!-- Blog Section Begin-->
   <div class="blof-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1">
                <div class="blog-sidebar">
                    <div class="recent-post">
                        <h4>Blog mới nhất</h4>
                        <div class="recent-blog">
                            @foreach ($blog_new as $key=>$blog_item)
                            <a href="{{route('blog-detail', $blog_item->slug)}}" class="rb-item">
                                <div class="rb-pic">
                                    <img src="{{asset('uploads/blog/'.$blog_item->image_cover)}}" alt="">
                                </div>
                                <div class="rb-text">
                                    <h6>{{$blog_item->title}}</h6>
                                    <p>Blog <span>-{{substr($blog_item->updated_at, 0, -9)}}</span></p>
                                </div>
                            </a>
                            @endforeach
                          
                        </div>
                    </div>
                    <div class="blog-tags">
                        <h4>Product Tags</h4>
                        <div class="tag-item">
                            <a href="#">Towel</a>
                            <a href="#">Shoes</a>
                            <a href="#">Coat</a>
                            <a href="#">Dresses</a>
                            <a href="#">Trousers</a>
                            <a href="#">Men's hats</a>
                            <a href="#">Backpack</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="row">
                    @foreach ($blog as $key=>$bg)
                    <div class="col-lg-6 col-sm-6">
                        <div class="blog-item">
                            <div class="bi-pic">
                               <a href="{{route('blog-detail', $bg->slug)}}"> 
                                <img src="{{asset('uploads/blog/'.$bg->image_cover)}}" alt="blog_image_error" height="280" width="410">
                            </a>
                            </div>
                            <div class="bi-text">
                                <a href="{{route('blog-detail', $bg->slug)}}">
                                    <h4>{{$bg->title}}</h4>
                                </a>
                                <p>Blog <span>{{$bg->updated_at}}</span></p>
                            </div>
                        </div>
                    </div>  
                    @endforeach
                </div>
                <div style="text-center">
                    {!!$blog->links("pagination::bootstrap-4")!!}
                   </div>
            </div>
        </div>
    </div>
   </div>
    <!--Blog Section End-->

@endsection