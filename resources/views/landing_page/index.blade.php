<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Core Consulting Engineers</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('landing/asset/img/favicon.png')}}" rel="icon">
    <link href="{{ asset('landing/asset/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('landing/asset/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('landing/asset/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
    <link href="{{ asset('landing/asset/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('landing/asset/vendor/animate.css')}}/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('landing/asset/vendor/venobox/venobox.css')}}" rel="stylesheet">
    <link href="{{asset('landing/asset/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('landing/asset/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('landing/asset/vendor/remixicon/remixicon.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('landing/asset/css/style.css')}}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Company - v2.1.0
  * Template URL: https://bootstrapmade.com/company-free-html-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <h1 class="logo mr-auto"><img src="{{asset('images/logo.png')}}" /></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo mr-auto"><img src="{{asset('landing/asset/img/logo.png')}}" alt="" class="img-fluid"></a>-->

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class="active"><a href="#">Home</a></li>

                    <!-- <li class="drop-down"><a href="">About</a>
                        <ul>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="team.html">Team</a></li>
                            <li><a href="testimonials.html">Testimonials</a></li>
                            <li class="drop-down"><a href="#">Deep Drop Down</a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->

                    <li><a href="#services">Services</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Sign Up</a></li>

                </ul>
            </nav><!-- .nav-menu -->
            <!--
            <div class="header-social-links">
                <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
                <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
                <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
                <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
            </div> -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

            <div class="carousel-inner" role="listbox">

                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url(landing/asset/img/slide/slide_1.jpg);">
                    <!-- <div class="carousel-container">
                        <div class="carousel-content animate__animated animate__fadeInUp">
                            <h2>Welcome to <span>Company</span></h2>
                            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                            <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
                        </div>
                    </div> -->
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item" style="background-image: url(landing/asset/img/slide/slide_2.jpg);">
                    <!-- <div class="carousel-container">
                        <div class="carousel-content animate__animated animate__fadeInUp">
                            <h2>Lorem Ipsum Dolor</h2>
                            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                            <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
                        </div>
                    </div> -->
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item" style="background-image: url(landing/asset/img/slide/slide_3.jpg);">
                    <!-- <div class="carousel-container">
                        <div class="carousel-content animate__animated animate__fadeInUp">
                            <h2>Sequi ea ut et est quaerat</h2>
                            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                            <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
                        </div>
                    </div> -->
                </div>

            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Us Section ======= -->
        <section id="about-us" class="about-us">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>About Us</strong></h2>
                </div>

                <div class="row content">
                    <div class="col-lg-6" data-aos="fade-right">
                        <h2>Core Consulting Engineers PLC</h2>
                        <h3>Always dedicated and devoted.</h3>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
                        <p>
                            Core Consulting Engineers is an engineering consulting company registered in Ethiopia with the
                            Ministry of Work and Urban Development (MoWUD), Ministry of Water Resource (MoWR),and Ministry of Environment,Forest and Climate Change (Category Ⅰ).
                            It specializes
                        </p>
                        <ul>
                            <li><i class="ri-check-double-line"></i>In the design and supervision of infrastructures</li>
                            <li><i class="ri-check-double-line"></i> Including but not limited to highways,bridges,airport,railways,water supply,dams</li>
                            <li><i class="ri-check-double-line"></i> Environmental impact assessment studies of different projects</li>
                        </ul>
                        <p class="font-italic">
                            Currently, CORE is also registered in <b>Tanzania</b> and <b>USA</b>.<br>
                            Its main objective is to provide Context Oriented Engineering Solutions to civil work
                            projects in the country and abroad. CORE is managed by senior engineering with
                            various specializations in civil engineering professions with more than twenty years of
                            relevant experience.
                        </p>
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Services</strong></h2>
                    <p>services that we provide</p>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100" style="padding-bottom: 30px;">
                        <div class="icon-box iconbox-blue" style="width: 600px;">
                            <div class="icon">
                                <img src="{{ asset('images/design.png')}}" width="100" height="100" alt="">
                            </div>
                            <h4>Detail Engineering Design</h4>
                            <p class="text-muted">Design of highway structures</p>
                            <p class="text-muted">Retrotting and Maintenance consultation</p>
                            <p class="text-muted">Design of(pipe,slab and box) culverts</p>
                            <p class="text-muted">Consultaion regarding and design or construction problem related to highway structures</p>
                            <p class="text-muted mb-5">Detailed engineering design</p>
                            <button class="btn btn-primary">See More</button>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box iconbox-orange ">
                            <div class="icon">
                                <img src="{{ asset('images/environment.jpg')}}" width="200" height="100" alt="">
                            </div>
                            <h4>Environmental & Social Impact Assessment & Environmental & Social Compliance Audit</h4>
                            <p class="text-muted">Baseline Study and Data Collection</p>
                            <p class="text-muted">ELSA Policy Document Reviews Environmental Scoping</p>
                            <p class="text-muted">Identification of valued and sensitive environmental components</p>
                            <p class="text-muted mb-5">Identification of Project influence area</p>
                            <button class="btn btn-primary">See More</button>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
                        <div class="icon-box iconbox-pink" style="width: 600px;">
                            <div class="icon">
                                <img src="{{ asset('images/supervision.png')}}" width="100" height="100" alt="">

                            </div>
                            <h4>Construction Supervision</h4>
                            <p class="text-muted">Construction supervision for Roads, Airports, Railways and Various underground structures,bridge,special structures, and the likeContract administration </p>
                            <p class="text-muted">Contract management</p>
                            <p class="text-muted mb-5">Environmental and Social Compliance Audit</p>
                            <button class="btn btn-primary">See More</button>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box iconbox-yellow" style="width: 600px;">
                            <div class="icon">
                                <img src="{{ asset('images/testing.png')}}" width="100" height="100" alt="">
                            </div>
                            <h4>Construction Material Testing</h4>
                            <p class="text-muted">Soil testing including Consolidation, Direct Shear & Collapse Potential</p>
                            <p class="text-muted">Coarse Aggregate testing(Coarse & Fine)</p>
                            <p class="text-muted">Fine Aggregate testing(Coarse & Fine)</p>
                            <p class="text-muted">Asphalt testing</p>
                            <p class="text-muted mb-5">Schmidt hammer testing</p>
                            <button class="btn btn-primary">See More</button>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box iconbox-red" style="width: 600px;">
                            <div class="icon">
                                <img src="{{ asset('images/geo.jpg')}}" width="100" height="100" alt="">
                            </div>
                            <h4><a href="">Geotechnical Engineering</a></h4>
                            <p class="text-muted">Borehole Drilling</p>
                            <p class="text-muted">Foundation Investigation And Design</p>
                            <p class="text-muted">Bearing Capacity Determination</p>
                            <p class="text-muted mb-5">Foundation Type Recommendation</p>
                            <button class="btn btn-primary">See More</button>
                        </div>
                    </div>
                    <!--
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
                        <div class="icon-box iconbox-teal">
                            <div class="icon">
                                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,566.797414625762C385.7384707136149,576.1784315230908,478.7894351017131,552.8928747891023,531.9192734346935,484.94944893311C584.6109503024035,417.5663521118492,582.489472248146,322.67544863468447,553.9536738515405,242.03673114598146C529.1557734026468,171.96086150256528,465.24506316201064,127.66468636344209,395.9583748389544,100.7403814666027C334.2173773831606,76.7482773500951,269.4350130405921,84.62216499799875,207.1952322260088,107.2889140133804C132.92018162631612,134.33871894543012,41.79353780512637,160.00259165414826,22.644507872594943,236.69541883565114C3.319112789854554,314.0945973066697,72.72355303640163,379.243833228382,124.04198916343866,440.3218312028393C172.9286146004772,498.5055451809895,224.45579914871206,558.5317968840102,300,566.797414625762"></path>
                                </svg>
                                <i class="bx bx-arch"></i>
                            </div>
                            <h4><a href="">Divera Don</a></h4>
                            <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
                        </div>
                    </div> -->

                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Portfolio Section ======= -->
        <!-- <section id="portfolio" class="portfolio">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Portfolio</h2>
                </div>

                <div class="row" data-aos="fade-up">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-app">App</li>
                            <li data-filter=".filter-card">Card</li>
                            <li data-filter=".filter-web">Web</li>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up">

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{asset('landing/asset/img/portfolio/portfolio-1.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 1</h4>
                            <p>App</p>
                            <a href="{{asset('landing/asset/img/portfolio/portfolio-1.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <img src="{{asset('landing/asset/img/portfolio/portfolio-2.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Web 3</h4>
                            <p>Web</p>
                            <a href="{{asset('landing/asset/img/portfolio/portfolio-2.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{asset('landing/asset/img/portfolio/portfolio-3.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 2</h4>
                            <p>App</p>
                            <a href="{{asset('landing/asset/img/portfolio/portfolio-3.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{asset('landing/asset/img/portfolio/portfolio-4.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Card 2</h4>
                            <p>Card</p>
                            <a href="{{asset('landing/asset/img/portfolio/portfolio-4.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <img src="{{asset('landing/asset/img/portfolio/portfolio-5.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Web 2</h4>
                            <p>Web</p>
                            <a href="{{asset('landing/asset/img/portfolio/portfolio-5.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{asset('landing/asset/img/portfolio/portfolio-6.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 3</h4>
                            <p>App</p>
                            <a href="{{asset('landing/asset/img/portfolio/portfolio-6.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{asset('landing/asset/img/portfolio/portfolio-7.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Card 1</h4>
                            <p>Card</p>
                            <a href="{{asset('landing/asset/img/portfolio/portfolio-7.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{asset('landing/asset/img/portfolio/portfolio-8.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Card 3</h4>
                            <p>Card</p>
                            <a href="{{asset('landing/asset/img/portfolio/portfolio-8.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <img src="{{asset('landing/asset/img/portfolio/portfolio-9.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Web 3</h4>
                            <p>Web</p>
                            <a href="{{asset('landing/asset/img/portfolio/portfolio-9.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>

                </div>

            </div>
        </section> -->
        <!-- End Portfolio Section -->

        <!-- Testimony -->
        <!-- <section class="testimonials" id="testimonials">
            <div class="container" data-aos="fade-up">
                <div class="section_title">
                    <h2>TESTIMONIALS</h2>
                    <p>What people says</p>
                </div>
                <div class="row no-gutters clearfix" data-aos="fade-up">
                </div>
            </div>
        </section> -->
        <!-- end testimony -->
        <!-- ======= Our Clients Section ======= -->
        <section id="clients" class="clients">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Clients</h2>
                </div>

                <div class="row no-gutters clearfix" data-aos="fade-up">

                    <div class="col-lg-3 col-md-4 col-6">
                        <img src="{{asset('images/era.png')}}" style="height: 180px; width:200; padding-bottom:20px" alt="">
                        <p class="text-dark">Ethiopian Road Authority(ERA)</p>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <img src="{{asset('images/ora_logo.jpg')}}" style="height: 180px; width:200;padding-left:30px; padding-bottom:55px" alt="">
                        <p class="text-dark">Oromia Road Authority(ORA)</p>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <img src="{{asset('images/Erc.jpg')}}" style="height: 180px; width:200;" alt="">
                        <p class="text-dark">Ethiopian Railway Corporation(ERC)</p>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <img src="{{asset('images/AACRA.jpg')}}" style="height: 180px; width:200; padding-bottom:20px" alt="">
                        <p class="text-dark">Addis Ababa City Road Authority(AACRA)</p>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <img src="{{asset('images/eae.jpg')}}" style="height: 180px; width:150" alt="">
                        <p class="text-dark">Ethiopia Airports Enterprise(EAE) </p>
                    </div>



                    <!-- <div class="col-lg-3 col-md-4 col-6">

                        <img src="{{asset('landing/asset/img/clients/client-6.png')}}" class="img-fluid" alt="">

                    </div>

                    <div class="col-lg-3 col-md-4 col-6">

                        <img src="{{asset('landing/asset/img/clients/client-7.png')}}" class="img-fluid" alt="">

                    </div>

                    <div class="col-lg-3 col-md-4 col-6">

                        <img src="{{asset('landing/asset/img/clients/client-8.png')}}" class="img-fluid" alt="">

                    </div> -->

                </div>

            </div>
        </section><!-- End Our Clients Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-6 footer-contact">
                        <h3>CORE CONSULTING ENGINEERS PLC</h3>
                        <p>
                            Nefas Silk Lafto Sub City, <br>
                            Wereda 04, H. NO. 1594 <br>
                            Sarbet infront of Oromia Offices 150m distance on the shortcut road to Vatican Embassy,<br>
                            Ethiopia <br><br>
                            <strong>Phone : </strong>+251-011-320 6033<br>
                            <strong>Email:</strong>coreconsultingengineers@gmail.com<br>
                        </p>
                    </div>



                    <!-- <div class="col-lg-6 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i>
                                <p>Detail Engineering Design</p>
                            </li>
                            <li><i class="bx bx-chevron-right"></i>
                                <p>Construction Supervision</p>
                            </li>
                            <li><i class="bx bx-chevron-right"></i>
                                <p>Construction Materials Testing</p>
                            </li>
                            <li><i class="bx bx-chevron-right"></i>
                                <p>Geotechnical Engineering</p>
                            </li>
                            <li><i class="bx bx-chevron-right"></i>
                                <p>Enviromental & Social Compliance Audit & Environmental & Social Compliance Audit</p>
                            </li>
                        </ul>
                    </div> -->

                    <!-- <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Join Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>
                    </div> -->

                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="mr-md-auto text-center text-md-left">
                <div class="copyright">
                    &copy; Copyright <strong><span>core consulting engineers</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/company-free-html-bootstrap-template/ -->
                    <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
                </div>
            </div>

        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('landing/asset/vendor/jquery/jquery.min.js')}}">
    </script>
    <script src="{{asset('landing/asset/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('landing/asset/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('landing/asset/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{asset('landing/asset/vendor/jquery-sticky/jquery.sticky.js')}}"></script>
    <script src="{{asset('landing/asset/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('landing/asset/vendor/venobox/venobox.min.js')}}"></script>
    <script src="{{asset('landing/asset/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('landing/asset/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('landing/asset/vendor/aos/aos.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('landing/asset/js/main.js')}}"></script>

</body>

</html>