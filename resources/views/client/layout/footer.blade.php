  <!-- FOOTER -->
  <footer class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer-left">
                    <div class="footer-logo">
                        <a href="{{route('homepage')}}">
                            <img src="{{asset('dashboard/assets/images/logo1.png')}}" alt="" >
                        </a>
                    </div>
                    <ul>
                        <li>17A Hai Ba Trung . Ha Noi</li>
                        <li>Phone: +84 43.12.56.347</li>
                        <li>Email: huyenha200204@gmail.com</li>
                    </ul>
                    <div class="footer-social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1">
                <div class="footer-widget">
                    <h5>Thông tin</h5>
                    <ul>
                        <li><a href="{{route('contact')}}">Liên hệ</a></li>
                        <li><a href="{{route('blogs')}}">Bài viết</a></li>
                        <li><a href="{{route('shop')}}">Shop</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="footer-widget">
                    <h5>My account</h5>
                    <ul>
                        <li><a href="{{route('history-purchase')}}">Account</a></li>
                        <li><a href="{{route('check-out')}}">Thanh toán</a></li>
                        <li><a href="{{route('list-cart')}}">Giỏ hàng</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="newslatter-item">
                <h5>Đăng ký nhận thông báo mới nhất</h5>
                <p>Điền Email để chúng tôi có thể liên hệ với bạn</p>
                <form action="#" class="subscribe-form">
                    <input type="text" placeholder="Điền Email của bạn: ">
                    <button type="button">Đăng ký</button>
                </form>
               </div>
            </div>
        </div>
    </div>
    <div class="copyright-reserved">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-text">
                        Copyright <script>document.write(new Date().getFullYear());</script> All rights reserved | PPSTYLE
                    </div>
                    <div class="payment-pic">
                        <img src="img/payment-method.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER END -->
