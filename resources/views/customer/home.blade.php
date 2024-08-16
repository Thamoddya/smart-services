<!doctype html>
<html lang="en">

<head>
    <title>Customer </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1,">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('customer/icons/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('customer/plugins/css/bootstrap.min.css') }}">
    <!-- Animate CSS-->
    <link rel="stylesheet" href="{{ asset('customer/plugins/css/animate.css') }}">
    <!-- Owl Carousel CSS-->
    <link rel="stylesheet" href="{{ asset('customer/plugins/css/owl.css') }}">
    <!-- Fancybox-->
    <link rel="stylesheet" href="{{ asset('customer/plugins/css/jquery.fancybox.min.css') }}">

    <!-- Custom CSS-->
    <link rel="stylesheet" href="{{ asset('customer/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/css/responsive.css') }}">

</head>

<body class="dark-vertion home-video black-bg">

    <!-- Start Loader -->
    {{-- <div class="section-loader">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div> --}}
    <!-- End Loader -->

    <section class="mh-home image-bg relative" id="mh-home">
        <div class="img-foverlay img-color-overlay">
            <!--
                Video section
                -->
            <div class="section-video">
                <video autoplay="" class="bgvid" loop="" muted="">
                    <!-- <source src="video/video.webm" type="video/webm"> -->
                    @if ($vehicle->vehicle_video)
                        <source src="{{ asset('storage/' . $vehicle->vehicle_video) }}" type="video/mp4">
                    @else
                        <source src="https://videos.pexels.com/video-files/4489802/4489802-uhd_2732_1440_25fps.mp4"
                            type="video/mp4">
                    @endif

                    <!-- <source src="video/video.ogv" type="video/ogv"> -->
                </video>
            </div>
            <div class="container">
                <div class="row section-separator xs-column-reverse vertical-middle-content home-padding">
                    <div class="col-sm-6">
                        <div class="mh-header-info">
                            <div class="mh-promo wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">
                                <span>Thank You For Joining with us</span>
                            </div>

                            <h2 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                {{ $customer->name }}</h2>
                            <h4 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                                {{ $serviceCenter->name }}
                            </h4>

                            <ul>
                                <li class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s"><i
                                        class="fa fa-envelope"></i><a href="mailto:">{{ $serviceCenter->email }}</a>
                                </li>
                                <li class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.5s"><i
                                        class="fa fa-phone"></i><a href="callto:">{{ $serviceCenter->mobile }}</a></li>
                                <li class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.6s"><i
                                        class="fa fa-map-marker"></i>
                                    <address>{{ $serviceCenter->address }}</address>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="hero-img wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.6s">
                            <div class="img-border">
                                <img src="{{ asset('storage/' . $vehicle->vehicle_photo) }}" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--
        ===================
           ABOUT
        ===================
        -->
    <section class="mh-about" id="mh-about">
        <div class="container">
            <div class="row section-separator">
                <div class="col-sm-12 col-md-6">
                    <div class="mh-about-img shadow-2 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">

                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="mh-about-inner">
                        <h2 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">Our Services</h2>
                        <div class="mh-about-tag wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                            <ul>
                                <li><span>Deep Interior Detailing</span></li>
                                <li><span>Premium quality cut and polish</span></li>
                                <li><span>Nano coating </span></li>
                                <li><span>Rat guard installing </span></li>
                                <li><span>Lubricant service </span></li>
                                <li><span>Engine tune up</span></li>
                                <li><span>Car Wash </span></li>
                                <li><span>All kind of Vehicle repairs </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mh-experince image-bg featured-img-one" id="mh-experience">

        <div class="img-color-overlay">
            <div class="container">
                <div class="row section-separator">
                    {{-- <div class="col-sm-12 col-md-6">
                        <div class="mh-education">
                            <h3 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">Service History
                            </h3>
                            <div class="mh-education-deatils">
                                <!-- Education Institutes-->
                                <div class="mh-education-item dark-bg wow fadeInUp" data-wow-duration="0.8s"
                                    data-wow-delay="0.3s">
                                    <h4>Art & Multimedia From <a href="#">Oxford University</a></h4>
                                    <div class="mh-eduyear">2005-2008</div>
                                    <p>It is a long established fact that a reader will be distracted by the readable
                                        content of a
                                        page when looking at its layout. The point of using Lorem Ipsum </p>
                                </div>
                                <!-- Education Institutes-->
                                <div class="mh-education-item dark-bg wow fadeInUp" data-wow-duration="0.8s"
                                    data-wow-delay="0.5s">
                                    <h4>Art & Multimedia From <a href="#">Oxford University</a></h4>
                                    <div class="mh-eduyear">2005-2008</div>
                                    <p>It is a long established fact that a reader will be distracted by the readable
                                        content of a
                                        page when looking at its layout. The point of using Lorem Ipsum </p>
                                </div>
                                <!-- Education Institutes-->
                                <div class="mh-education-item dark-bg wow fadeInUp" data-wow-duration="0.8s"
                                    data-wow-delay="0.6s">
                                    <h4>Art & Multimedia From <a href="#">Oxford University</a></h4>
                                    <div class="mh-eduyear">2005-2008</div>
                                    <p>It is a long established fact that a reader will be distracted by the readable
                                        content of a
                                        page when looking at its layout. The point of using L orem Ipsum </p>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-sm-12">
                        <div class="mh-work">
                            <h3>Service History</h3>
                            <div class="mh-experience-deatils">

                                @foreach ($vehicleServices as $service)
                                    {{-- <div class="mh-work-item dark-bg wow fadeInUp" data-wow-duration="0.8s" --}}
                                    {{-- data-wow-delay="0.2s">
                                        <h4>Service Type: {{ $service->service_type }}</h4>
                                        <div class="mh-eduyear mb-2">Invoice Number: {{ $service->invoice_number }}
                                        </div>
                                        <div class="mh-eduyear
                                            mb-2">Date:
                                            {{ date('d-m-Y', strtotime($service->created_at)) }}</div>
                                        <div class="mh-eduyear
                                            mb-2">Time:
                                            {{ date('h:i A', strtotime($service->created_at)) }}</div>
                                        <div class="mh-eduyear
                                            mb-2">
                                            Service Cost: Rs.{{ $service->full_cost }}.00</div>
                                        <div class="mh-eduyear
                                            mb-2">
                                            Vehicle ID: {{ $service->vehicle_id }}</div>
                                        <div class="mh-eduyear
                                            mb-2">
                                            Customer Name: {{ $service->vehicle->customer->name }}</div>
                                        <div class="mh-eduyear
                                            mb-2">
                                            Vehicle Model: {{ $service->vehicle->model }}</div>
                                        <div class="mh-eduyear mb-2">Vehicle Number:
                                            {{ $service->vehicle->vehicle_number }}
                                        </div>
                                        <div class="mh-eduyear
                                            mb-2">
                                            Service Center: {{ $service->serviceCenter->name }}</div>
                                        <div class="mh-eduyear
                                            mb-2">
                                            Service Center Address: {{ $service->serviceCenter->address }}</div>
                                        <div class="mh-eduyear
                                            mb-2">
                                            Service Center Email: {{ $service->serviceCenter->email }}</div>
                                        <div class="mh-eduyear
                                            mb-2">
                                            Service Center Mobile: {{ $service->serviceCenter->mobile }}</div>
                                    </div> --}}
                                    <div class="mh-work-item dark-bg wow fadeInUp" data-wow-duration="0.8s"
                                        data-wow-delay="0.4s">
                                        <h4>{{ $service->service_type }} <a
                                                href="#">#{{ $service->invoice_number }}</a></h4>
                                        <div class="mh-eduyear">Rs.{{ $service->full_cost }}.00</div>
                                        <div class="mh-eduyear">Milage : {{ $service->service_milage }} KM</div>
                                        <span>Detail :</span>
                                        <ul class="work-responsibility">
                                            <li><i class="fa fa-circle"></i>{{ $service->service_details }}</li>
                                        </ul>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--
        ===================
           Testimonial
        ===================
        -->
    {{-- <section class="mh-testimonial" id="mh-testimonial">
        <div class="home-v-img">
            <div class="container">
                <div class="row section-separator">
                    <div class="col-sm-12 section-title wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                        <h3>Client Reviews</h3>
                    </div>
                    <div class="col-sm-12 wow fadeInUp" id="mh-client-review" data-wow-duration="0.8s"
                        data-wow-delay="0.3s">
                        <div class="each-client-item">
                            <div class="mh-client-item dark-bg black-shadow-1">
                                <img src="images/c-1.png" alt="" class="img-fluid">
                                <p>Absolute wonderful ! I am completely
                                    blown away.The very best.I was amazed
                                    at the quality</p>
                                <h4>John Mike</h4>
                                <span>CEO, Author.Inc</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!--
        ===================
           FOOTER 3
        ===================
        -->
    <footer class="mh-footer mh-footer-3" id="mh-contact">
        <div class="container-fluid">
            <div class="row section-separator">
                <div class="col-sm-12 section-title wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                    <h3>Contact Me</h3>
                </div>
                <div class="map-image image-bg col-sm-12">
                    <div class="container mt-30">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mh-footer-address">
                                <div class="col-sm-12 xs-no-padding">
                                    <div class="mh-address-footer-item dark-bg shadow-1 media wow fadeInUp"
                                        data-wow-duration="0.8s" data-wow-delay="0.2s">
                                        <div class="each-icon">
                                            <i class="fa fa-location-arrow"></i>
                                        </div>
                                        <div class="each-info media-body">
                                            <h4>Address</h4>
                                            <address>
                                                {{ $serviceCenter->address }}
                                            </address>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 xs-no-padding">
                                    <div class="mh-address-footer-item media dark-bg shadow-1 wow fadeInUp"
                                        data-wow-duration="0.8s" data-wow-delay="0.4s">
                                        <div class="each-icon">
                                            <i class="fa fa-envelope-o"></i>
                                        </div>
                                        <div class="each-info media-body">
                                            <h4>Email</h4>
                                            <a
                                                href="mailto:{{ $serviceCenter->email }}">{{ $serviceCenter->email }}</a><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 xs-no-padding">
                                    <div class="mh-address-footer-item media dark-bg shadow-1 wow fadeInUp"
                                        data-wow-duration="0.8s" data-wow-delay="0.6s">
                                        <div class="each-icon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div class="each-info media-body">
                                            <h4>Phone</h4>
                                            <a
                                                href="callto:{{ $serviceCenter->mobile }}">{{ $serviceCenter->mobile }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mh-copyright wow fadeInUp" data-wow-duration="0.8s"
                                data-wow-delay="0.2s">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="text-left text-xs-center">
                                            <p>All right reserved Texta World 2024</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <!-- jQuery -->
    <script src="{{ asset('customer/plugins/js/jquery.min.js') }}"></script>
    <!-- popper -->
    <script src="{{ asset('customer/plugins/js/popper.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('customer/plugins/js/bootstrap.min.js') }}"></script>
    <!-- owl carousel -->
    <script src="{{ asset('customer/plugins/js/owl.carousel.js') }}"></script>
    <!-- validator -->
    <script src="{{ asset('customer/plugins/js/validator.min.js') }}"></script>
    <!-- wow -->
    <script src="{{ asset('customer/plugins/js/wow.min.js') }}"></script>
    <!-- mixin js-->
    <script src="{{ asset('customer/plugins/js/jquery.mixitup.min.js') }}"></script>
    <!-- circle progress-->
    <script src="{{ asset('customer/plugins/js/circle-progress.js') }}"></script>
    <!-- jquery nav -->
    <script src="{{ asset('customer/plugins/js/jquery.nav.js') }}"></script>
    <!-- Fancybox js-->
    <script src="{{ asset('customer/plugins/js/jquery.fancybox.min.js') }}"></script>
    <!-- Map api -->
    <script src="{{ asset('customer/plugins/js/isotope.pkgd.js') }}"></script>
    <script src="{{ asset('customer/plugins/js/packery-mode.pkgd.js') }}"></script>
    <!-- Custom Scripts-->
    <script src="{{ asset('js/custom-scripts.js') }}"></script>



</body>

</html>
