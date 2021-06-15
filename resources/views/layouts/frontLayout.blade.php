<!DOCTYPE html>
<html lang="{{session()->get('locale')}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Toko QR - Pembuat Toko Digital Sederhana">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content=""/> <!-- website name -->
    <meta property="og:site" content=""/> <!-- website link -->
    <meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
    <meta property="og:description" content=""/> <!-- description shown in the actual shared post -->
    <meta property="og:image" content=""/> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content=""/> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article"/>

    <!-- Website Title -->
    <title>Toko QR - Pembuat Toko Digital Sederhana</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
          rel="stylesheet">
    <link href="{{asset('front/css/bootstrap.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link href="{{asset('front/css/swiper.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/styles.css')}}" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="{{asset('uploads/'.json_decode(get_settings('site_setting'))->favicon)}}">
</head>
<body data-spy="scroll" data-target=".fixed-top">


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">

        <!-- Image Logo -->
        <a class="navbar-brand logo-image" href="{{route('index')}}"><img
                src="{{asset('front/images/logotokoqr-removebg-preview.png')}}" alt="alternative"></a>

        <!-- Mobile Menu Toggle Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-awesome fas fa-bars"></span>
            <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>
        <!-- end of mobile menu toggle button -->

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#header">{{trans('layout.home')}} <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#details">{{trans('layout.demo')}}</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#pricing">{{trans('layout.pricing')}}</a>
                </li>
            </ul>
            <span class="nav-item">
                    <a target="_blank" class="btn-outline-sm" href="{{route('login')}}">{{trans('layout.login')}}</a>
                </span>
        </div>
    </div> <!-- end of container -->
</nav> <!-- end of navbar -->
<!-- end of navigation -->


<!-- Header -->
<header id="header" class="header">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5">
                    <div class="text-container">
                        <h1>Toko QR</h1>
                        <p class="p-large">Pembuat Menu Digital Sederhana</p>
                        <a target="_blank" class="btn-solid-lg page-scroll"
                           href="{{route('registration')}}">Buat Menu Sendiri</a>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6 col-xl-7">
                    <div class="image-container">
                        <div class="img-wrapper">
                            <img class="img-fluid" src="{{asset('front/images/logotokoqr.png')}}" alt="alternative">
                        </div> <!-- end of img-wrapper -->
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of header-content -->
</header> <!-- end of header -->
<svg class="header-frame" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
     viewBox="0 0 1920 310">
    <defs>
        <style>.cls-1 {
                fill: #26b99d;
            }</style>
    </defs>
    <title>header-frame</title>
    <path class="cls-1"
          d="M0,283.054c22.75,12.98,53.1,15.2,70.635,14.808,92.115-2.077,238.3-79.9,354.895-79.938,59.97-.019,106.17,18.059,141.58,34,47.778,21.511,47.778,21.511,90,38.938,28.418,11.731,85.344,26.169,152.992,17.971,68.127-8.255,115.933-34.963,166.492-67.393,37.467-24.032,148.6-112.008,171.753-127.963,27.951-19.26,87.771-81.155,180.71-89.341,72.016-6.343,105.479,12.388,157.434,35.467,69.73,30.976,168.93,92.28,256.514,89.405,100.992-3.315,140.276-41.7,177-64.9V0.24H0V283.054Z"/>
</svg>
<br><br> <br><br>
<!-- end of header -->


<!-- Description -->
<div class="cards-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="above-heading">---------------</div>
                <h2 class="h2-heading">Ini adalah pembuat menu digital paling fleksibel dan ramah pengguna yang pernah ada!</h2>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-12">

                <!-- Card -->
                <div class="card">
                    <div class="card-image">
                        <img class="img-fluid" src="{{asset('front/images/description-1.png')}}" alt="alternative">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Desain Sederhana & Menarik </h4>
                        <p>TokoQR sangat mudah digunakan dengan desain yang sederhana dan penuh warna. Buat profil Anda, buat profil Anda
                            menu dan baik untuk pergi. </p>
                    </div>
                </div>
                <!-- end of card -->

                <!-- Card -->
                <div class="card">
                    <div class="card-image">
                        <img class="img-fluid" src="{{asset('front/images/description-2.png')}}" alt="alternative">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Hasilkan QR & Desain</h4>
                        <p>Anda dapat membuat kode QR desain Anda sendiri dan mengunduh gambarnya.</p>
                    </div>
                </div>
                <!-- end of card -->

                <!-- Card -->
                <div class="card">
                    <div class="card-image">
                        <img class="img-fluid" src="{{asset('front/images/description-3.png')}}" alt="alternative">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Mendapatkan Live</h4>
                        <p>Buat menu Anda sendiri dengan Kode QR desain sendiri. </p>
                    </div>
                </div>
                <!-- end of card -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of cards-1 -->
<!-- end of description -->


<!-- Demo -->
<div id="details" class="basic-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-container">
                    <h2>Pindai Kode QR Untuk Melihat DEMO</h2>
                    <p>Untuk melihat demo langsung, cukup pindai kode QR dengan kamera ponsel atau pemindai kode QR Anda. </p>
                    <a class="btn-solid-reg page-scroll" href="{{route('registration')}}">{{trans('layout.signup')}}</a>
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">
                <div class="image-container">
                    <img class="img-fluid" src="{{asset('front/images/demo.jpg')}}" alt="alternative">
                </div> <!-- end of image-container -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of basic-1 -->
<!-- end of demo -->


<!-- Pricing -->
<div id="pricing" class="cards-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="h2-heading">Tabel Pilihan Harga</h2>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-12">

                @foreach($plans as $plan)
                <!-- Card-->
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">{{$plan->title}}</div>
                        <div class="price"><span class="value">{{formatNumberWithCurrSymbol($plan->cost)}}</span></div>
                        <div class="frequency">{{$plan->recurring_type}}</div>
                        <div class="divider"></div>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-check"></i>
                                <div class="media-body">
                                    @if($plan->item_unlimited=='yes')
                                        {{trans('layout.unlimited_items')}}
                                    @else
                                        <strong>{{$plan->item_limit}}</strong>
                                        {{trans('layout.item_limit')}}
                                    @endif
                                </div>
                            </li>
                            <li class="media">
                                <i class="fas fa-check"></i>
                                <div class="media-body">
                                    @if($plan->table_unlimited=='yes')
                                        {{trans('layout.unlimited_tables')}}
                                    @else
                                        <strong>{{$plan->table_limit}}</strong>
                                        {{trans('layout.table_limit')}}
                                    @endif
                                </div>
                            </li>
                            <li class="media">
                                <i class="fas fa-check"></i>
                                <div class="media-body">
                                    @if($plan->restaurant_unlimited=='yes')
                                        {{trans('layout.unlimited_restaurants')}}
                                    @else
                                        <strong>{{$plan->restaurant_limit}}</strong>
                                        {{trans('layout.restaurant_limit')}}
                                    @endif
                                </div>
                            </li>
                            <li class="media">
                                <i class="fas fa-check"></i>
                                <div class="media-body">
                                    {{trans('layout.unlimited_support')}}
                                </div>
                            </li>

                        </ul>
                        <div class="button-wrapper">
                            <a class="btn-solid-reg page-scroll" href="{{route('registration',['plan'=>$plan->id])}}">{{trans('layout.join')}}</a>
                        </div>
                    </div>
                </div> <!-- end of card -->
                <!-- end of card -->
                @endforeach

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of cards-2 -->
<!-- end of pricing -->




<!-- Newsletter -->
<div class="form">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-container">
                    <div class="above-heading">NEWSLETTER</div>
                    <h2>Tetap Update Dengan Berita Terbaru</h2>

                    <!-- Newsletter Form -->
                    <form method="post" action="{{route('subscribe')}}" id="newsletterForm" data-toggle="validator" data-focus="false">
                      @csrf
                        <div class="form-group">
                            <input name="email" type="email" class="form-control-input" id="nemail" required>
                            <label class="label-control" for="nemail">Email</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group checkbox">
                            <input type="checkbox" id="nterms" value="Agreed-to-Terms" required>I've read and agree to
                            PicoQR's written <a href="privacy-policy.html">Privacy Policy</a> and <a
                                href="terms-conditions.html">Terms Conditions</a>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control-submit-button">SUBSCRIBE</button>
                        </div>
                        <div class="form-message">
                            <div id="nmsgSubmit" class="h3 text-center hidden"></div>
                        </div>
                    </form>
                    <!-- end of newsletter form -->

                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="icon-container">
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                    <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x"></i>
                            </a>
                        </span>
                    <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-pinterest-p fa-stack-1x"></i>
                            </a>
                        </span>
                    <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x"></i>
                            </a>
                        </span>
                    <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-linkedin-in fa-stack-1x"></i>
                            </a>
                        </span>
                </div> <!-- end of col -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of form -->
<!-- end of newsletter -->


<!-- Footer -->
<svg class="footer-frame" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
     viewBox="0 0 1920 79">
    <defs>
        <style>.cls-2 {
                fill: #26b99d;
            }</style>
    </defs>
    <title>footer-frame</title>
    <path class="cls-2"
          d="M0,72.427C143,12.138,255.5,4.577,328.644,7.943c147.721,6.8,183.881,60.242,320.83,53.737,143-6.793,167.826-68.128,293-60.9,109.095,6.3,115.68,54.364,225.251,57.319,113.58,3.064,138.8-47.711,251.189-41.8,104.012,5.474,109.713,50.4,197.369,46.572,89.549-3.91,124.375-52.563,227.622-50.155A338.646,338.646,0,0,1,1920,23.467V79.75H0V72.427Z"
          transform="translate(0 -0.188)"/>
</svg>
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-col first">
                    <h4>Tentang Toko QR</h4>
                    <p class="p-small">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac facilisis
                        nisi, sit amet volutpat urna.</p>
                </div>
            </div> <!-- end of col -->
            <div class="col-md-4">
                <div class="footer-col middle">
                    <h4>Important Links</h4>
                    <ul class="list-unstyled li-space-lg p-small">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Our business partners <a class="white" href="#">qr.picotech.app</a>
                            </div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Read our <a class="white" href="#">Terms & Conditions</a>, <a
                                    class="white" href="#">Privacy Policy</a></div>
                        </li>
                    </ul>
                </div>
            </div> <!-- end of col -->
            <div class="col-md-4">
                <div class="footer-col last">
                    <h4>Contact</h4>
                    <ul class="list-unstyled li-space-lg p-small">
                        <li class="media">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="media-body">Modhure More, Kurigram, BD</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-envelope"></i>
                            <div class="media-body"><a class="white" href="#">contact@picotech.com</a> <i
                                    class="fas fa-globe"></i><a class="white" href="#your-link">qr.picotech.app</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of footer -->
<!-- end of footer -->


<!-- Copyright -->
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="p-small">Copyright © {{date('Y')}}</p>
            </div> <!-- end of col -->
        </div> <!-- enf of row -->
    </div> <!-- end of container -->
</div> <!-- end of copyright -->
<!-- end of copyright -->


<!-- Scripts -->
<script src="{{asset('front/js/jquery.min.js')}}"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
<script src="{{asset('front/js/popper.min.js')}}"></script> <!-- Popper tooltip library for Bootstrap -->
<script src="{{asset('front/js/bootstrap.min.js')}}"></script> <!-- Bootstrap framework -->
<script src="{{asset('front/js/jquery.easing.min.js')}}"></script>
<!-- jQuery Easing for smooth scrolling between anchors -->
<script src="{{asset('front/js/swiper.min.js')}}"></script> <!-- Swiper for image and text sliders -->
<script src="{{asset('front/js/jquery.magnific-popup.js')}}"></script> <!-- Magnific Popup for lightboxes -->
<script src="{{asset('front/js/scripts.js')}}"></script> <!-- Custom scripts -->
</body>
</html>
