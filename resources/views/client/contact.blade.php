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
                    <span>Liên hệ</span>
                </div>
            </div>
        </div>
    </div>
</div>
  <!--Breadcrumb section end-->
    <!--Map Section Begin-->
    <div class="map spad">
        <div class="container">
            <div class="map-inner">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3727.338901828509!2d105.86461510925857!3d20.898680592156285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135b213939691c5%3A0xbcc2ea0a11ce677d!2sDuy%C3%AAn%20Th%C3%A1i%20Residence!5e0!3m2!1svi!2s!4v1673275770450!5m2!1svi!2s" width="600" 
                height="610" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <div class="icon">
                <i class="fa fa-map-marker"></i>
            </div>
            </div>
        </div>
</div>
<!--Map Section End-->

        <!--Contact Section Begin-->
        <div class="contact-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="contact-title">
                            <h4>Contacts Us</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                 the industry's standard dummy text ever since the 1500s.</p>
                        </div>
                        <div class="contact-widget">
                           <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-location-pin"></i>
                            </div>
                            <div class="ci-text">
                                <span>Address:</span>
                                <p>17A Hai Ba Trung . Ha Noi</p>
                            </div>
                           </div>
                           <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="ci-text">
                                <span>Phone:</span>
                                <p>+84 43.23.45.432</p>
                            </div>
                           </div>
                           <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-email"></i>
                            </div>
                            <div class="ci-text">
                                <span>Email:</span>
                                <p>huyenha200204@gmail.com</p>
                            </div>
                           </div>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-lg-1">
                        <div class="contact-form">
                            <div class="leave-comment">
                                <h4>Leave A Comment</h4>
                                <p>Dur staff will call back later and answer your questions.</p>
                                <form action="#" class="comment-form">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" name="" id="" placeholder="Your Name">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" name="" id="" placeholder="Your Email">
                                        </div>
                                        <div class="col-lg-12">
                                            <textarea name="" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
                                            <button type="button" class="site-btn">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Contact Section Begin-->
@endsection