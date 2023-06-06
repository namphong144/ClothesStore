@extends('client.layout.layout')
@section('title', 'Homepage')
@section('body')
         <!-- Blog detail Section Begin-->
         <div class="blog-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-details-inner">
                            <div class="blog-detail-title">
                                <h2>{{$blog_detail->title}}</h2>
                                <p>Blog written by {{$blog_detail->user->name}}<span>-{{$blog_detail->updated_at}}</span></p>
                            </div>
                            <div class="blog-large-pic">
                                <img src="{{asset('uploads/blog/'.$blog_detail->image_cover)}}" alt="" style="width: 100%">
                            </div>
                            <div class="blog-quote" style="margin-top:50px">
                                <p>{{$blog_detail->sub_title}}</p>
                            </div>
                            <div class="blog-detail-desc">
                                    {!!$blog_detail->content!!}
                            </div>
                            <div class="blog-more">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="img/blog/blog-detail-1.jpg" alt="">
                                    </div>
                                    <div class="col-sm-4">
                                        <img src="img/blog/blog-detail-2.jpg" alt="">
                                    </div>
                                    <div class="col-sm-4">
                                        <img src="img/blog/blog-detail-3.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="tag-share">
                                <div class="details-tag">
                                    <ul>
                                        <li><i class="fa fa-tags"></i></li>
                                        <li>thời trang nam</li>
                                        <li>thời trang nữ</li>
                                    </ul>
                                </div>
                                <div class="blog-share">
                                    <span>Share:</span>
                                    <div class="social-links">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-post">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <a href="{{route('blog-detail', $blog_more->slug)}}" class="prev-blog">
                                            <div class="pb-pic">
                                                <i class="ti-arrow-left"></i>
                                                <img src="{{asset('uploads/blog/'.$blog_more->image_cover)}}" alt="">
                                            </div>
                                            <div class="pb-text">
                                                <span>Previous Post:</span>
                                                <h5>{{$blog_more->title}}</h5>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-5 col-md-6 offset-lg-2">
                                        <a href="{{route('blog-detail', $blog_more2->slug)}}" class="next-blog">
                                            <div class="nb-pic">
                                                <img src="{{asset('uploads/blog/'.$blog_more2->image_cover)}}" alt="">
                                                <i class="ti-arrow-right"></i>
                                            </div>
                                            <div class="nb-text">
                                                <span>Next Post:</span>
                                                <h5>{{$blog_more2->title}}</h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="leave-comment">
                                <h4>Leave A Comment</h4>
                                <form action="#" class="comment-form">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" name="" id="" placeholder="Name">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" name="" id="" placeholder="Email">
                                        </div>
                                        <div class="col-lg-12">
                                            <textarea name="" id="" cols="30" rows="10" placeholder="Messages"></textarea>
                                            <button type="submit" class="site-btn">Send messages</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
          <!-- Blog detail Section End-->
@endsection