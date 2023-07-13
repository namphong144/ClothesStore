<!doctype html>
<html lang="en">

<head>
    <base href="{{asset('/')}}">
    <meta charset="utf-8">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PPSTYLE Shop - @yield('title')</title>
    <meta property="og:image" content="public/dashboard/assets/images/logo1.png" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="55" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="PPSTYLE Store">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    {{-- DATATABLE --}}
    {{-- <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <link href=" https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    {{-- MORRIS CHART --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <link href="./dashboard/main.css" rel="stylesheet">
    <link href="./dashboard/my_style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <a href="{{url('admin')}}">
                    {{-- <div class="logo-src"></div> --}}
                    <img src="{{asset('dashboard/assets/images/logo1.png')}}" alt="" width="110px" height="35px">
                </a>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-right">
                    <div class="header-dots">
                    </div>

                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="https://scontent.fhan14-4.fna.fbcdn.net/v/t1.6435-9/167824254_264805348681782_160531787177151931_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=w94Beheevd8AX8M_zQM&_nc_ht=scontent.fhan14-4.fna&oh=00_AfAaLZbP_fpLemvB7jMvDARagq9e1AwpCAyi_9xh3WPUcg&oe=64ABA419"
                                                alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner bg-info">
                                                    <div class="menu-header-image opacity-2"
                                                        style="background-image: url('assets/images/dropdown-header/city3.jpg');">
                                                    </div>
                                                    <div class="menu-header-content text-left">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">

                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">{{ Auth::user()->name }}</div>
                                                                    {{-- <div class="widget-subheading opacity-8">A short
                                                                        profile description</div> --}}
                                                                </div>
                                                                <div class="widget-content-right mr-2">

                                                                    <a href="{{ route('logout') }}"
                                                                    onclick="event.preventDefault();
                                                                                  document.getElementById('logout-form').submit();"><button
                                                                        class="btn-pill btn-shadow btn-shine btn btn-focus">Logout</button> </a>
                                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                                            @csrf
                                                                        </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading"> {{ Auth::user()->name }} </div>
                                    <div class="widget-subheading"> @if ( Auth::user()->level == 0)
                                        {{ __('Staff') }}
                                       @else

                                       {{ __('Manager') }}
                                    @endif </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <button type="button"
                                        class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-btn-lg">
                        <button type="button" class="hamburger hamburger--elastic open-right-drawer">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

      @include('layouts.ui-theme')

       @include('layouts.sidebar')

    </div>
    <div class="app-drawer-wrapper">
        <div class="drawer-nav-btn">
            <button type="button" class="hamburger hamburger--elastic is-active">
                <span class="hamburger-box"><span class="hamburger-inner"></span></span>
            </button>
        </div>
        <div class="drawer-content-wrapper">
            <div class="scrollbar-container">
                <h3 class="drawer-heading">Servers Status</h3>
                <div class="drawer-section">
                    <div class="row">
                        <div class="col">
                            <div class="progress-box">
                                <h4>Server Load 1</h4>
                                <div class="circle-progress circle-progress-gradient-xl mx-auto">
                                    <small></small>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="progress-box">
                                <h4>Server Load 2</h4>
                                <div class="circle-progress circle-progress-success-xl mx-auto">
                                    <small></small>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="progress-box">
                                <h4>Server Load 3</h4>
                                <div class="circle-progress circle-progress-danger-xl mx-auto">
                                    <small></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="mt-3">
                        <h5 class="text-center card-title">Live Statistics</h5>
                        <div id="sparkline-carousel-3"></div>
                        <div class="row">
                            <div class="col">
                                <div class="widget-chart p-0">
                                    <div class="widget-chart-content">
                                        <div class="widget-numbers text-warning fsize-3">43</div>
                                        <div class="widget-subheading pt-1">Packages</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="widget-chart p-0">
                                    <div class="widget-chart-content">
                                        <div class="widget-numbers text-danger fsize-3">65</div>
                                        <div class="widget-subheading pt-1">Dropped</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="widget-chart p-0">
                                    <div class="widget-chart-content">
                                        <div class="widget-numbers text-success fsize-3">18</div>
                                        <div class="widget-subheading pt-1">Invalid</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="text-center mt-2 d-block">
                            <button class="mr-2 border-0 btn-transition btn btn-outline-danger">Escalate Issue</button>
                            <button class="border-0 btn-transition btn btn-outline-success">Support Center</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="app-drawer-overlay d-none animated fadeIn"></div>

    <script src="dashboard/assets/scripts/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script type="text/javascript" src="./dashboard/assets/scripts/main.js"></script>
    <script type="text/javascript" src="./dashboard/assets/scripts/my_script.js"></script>

    {{-- <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>  --}}
    <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

    {{-- <script>
        $(document).ready(function() {
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
    </script> --}}

<script type="text/javascript">
    function ChangeToSlug()
        {
            var slug;

            //Lấy text từ thẻ input title
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '-');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>

     <script type="text/javascript">
        $('.orderst_choose').change(function(){
          var orderst_val = $(this).val();
          var order_id = $(this).attr('id');
          $.ajax({
                  url: "{{ route('orderst-choose') }}",
                  method: "GET",
                  data: {
                      orderst_val:orderst_val,
                      order_id:order_id
                  },
                  success: function(data) {
                     alert('Thay đổi thành công!');
                     setTimeout(
                  function()
                  {
                     location.reload();
                  }, 0001);
                  }
              });
        })
    </script>

<script>
    $( function() {
    $( "#datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
    });
    $( "#datepicker2" ).datepicker({
        // prevText: "Tháng trước",
        // nextText: "Tháng sau",
        dateFormat: 'yy-mm-dd',
        // dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5""Thứ 6", "Thứ 7", "Chủ nhật"],
        // duration: "slow"
    });
    } );
</script>

<script type="text/javascript">
        $(document).ready(function() {
        chart60daysorder();
        var chart = new Morris.Line({

        element: 'myfirstchart',
        //option chart
        lineColors: ['#819C79', '#fc8710', 'FF6541', '#A4ADD3', '#766B56'],
        parseTime: false,
       // hideHover: auto,

       xkey: 'period',

        ykeys: ['order', 'sales', 'profit'],

        labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận']
        });

        function chart60daysorder() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('month-order') }}",
                method: "POST",
                dataType: "JSON",
                data: {
                    _token:_token,
                },
                success:function(data) {
                    chart.setData(data);
                }
            });
        }

        $('.dashboard-filter').change(function() {
            var dashboard_value = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('dashboard-filter') }}",
                method: "POST",
                dataType: "JSON",
                data: {
                    dashboard_value:dashboard_value,
                    _token:_token,
                },
                success:function(data) {
                    chart.setData(data);
                }
            });
        });

        $('#btn-dashboard-filter').click(function() {
        var _token = $('input[name="_token"]').val();

        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
        $.ajax({
                url: "{{ route('filter-by-date') }}",
                method: "POST",
                dataType: "JSON",
                data: {
                    from_date:from_date,
                    to_date:to_date,
                    _token:_token,
                },
                success:function(data) {
                    chart.setData(data);
                }
            });

    });
});
</script>


@yield('script')
</body>

</html>
