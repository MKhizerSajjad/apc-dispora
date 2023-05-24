<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="imgs/Logo.jpg" />
    <!-- Template CSS -->
    <!-- <link rel="stylesheet" href="css/plugins/animate.min.css" /> -->
    <link rel="stylesheet" href="css/mainff29.css?v=5.5" />
</head>
<body>
    
    <header class="header-area header-style-1 header-height-2">
        <div class="mobile-promotion">
            <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
        </div>
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                <li><a href="{{route('about')}}">About Us</a></li>
                                <li><a href="">My Account</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="">Order Tracking</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul>
                                    <li>100% Secure delivery without contacting the courier</li>
                                    <li>Supper Value Deals - Save more with coupons</li>
                                    <li>Trendy 25silver jewelry, save up 35% off today</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                <li>Need help? Call Us: <strong class="text-brand"> + 1800 900</strong></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="index.html"><img src="imgs/logo.jpg" alt="logo" /></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form action="#">
                                <input type="text" placeholder="Search for items..." />
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="search-location">
                                    <form action="#">
                                        <select class="select-active">
                                            <option>Your Location</option>
                                            <option>Alabama</option>
                                            <option>Alaska</option>
                                            <option>Arizona</option>
                                            <option>Delaware</option>
                                            <option>Florida</option>
                                            <option>Georgia</option>
                                            <option>Hawaii</option>
                                            <option>Indiana</option>
                                            <option>Maryland</option>
                                            <option>Nevada</option>
                                            <option>New Jersey</option>
                                            <option>New Mexico</option>
                                            <option>New York</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="header-action-icon-2">
                                    <a href="">
                                        <img class="svgInject" alt="Nest"
                                            src="imgs/theme/icons/icon-heart.svg" />
                                        <span class="pro-count blue">6</span>
                                    </a>
                                    <a href=""><span class="lable">Wishlist</span></a>
                                </div>
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="">
                                        <img alt="Nest" src="imgs/theme/icons/icon-cart.svg" />
                                        <span class="pro-count blue">2</span>
                                    </a>
                                    <a href=""><span class="lable">Cart</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                        <ul>
                                            <li>
                                                <div class="shopping-cart-img">
                                                    <a href=""><img alt="Nest"
                                                            src="imgs/wall-art-g4f306dc76_1920.jpg" /></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href=""> Casual paint</a></h4>
                                                    <h4><span>1 × </span>$800.00</h4>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="shopping-cart-img">
                                                    <a href=""><img alt="Nest"
                                                            src="imgs/wall-art-g4f306dc76_1920.jpg" /></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href=""> pating</a></h4>
                                                    <h4><span>1 × </span>$3200.00</h4>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total <span>$4000.00</span></h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="" class="outline">View cart</a>
                                                <a href="">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-action-icon-2">
                                    <a href="">
                                        <img class="svgInject" alt="Nest" src="imgs/theme/icons/icon-user.svg" />
                                    </a>
                                    <a href=""><span class="lable ml-0">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li>
                                                <a href=""><i class="fi fi-rs-user mr-10"></i>My Account</a>
                                            </li>
                                            <li>
                                                <a href=""><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                            </li>
                                            <li>
                                                <a href=""><i class="fi fi-rs-label mr-10"></i>My Voucher</a>
                                            </li>
                                            <li>
                                                <a href=""><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a>
                                            </li>
                                            <li>
                                                <a href=""><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                            </li>
                                            <li>
                                                <a href=""><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 logo-sticky">
                        <a href=""><img src="imgs/logo.jpg" alt="logo" /></a>
                    </div>
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href=""><img src="imgs/logo.jpg" alt="logo" /></a>
                    </div>

                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading mx-auto">
                        <nav>
                            <ul>
                                <li>
                                    <a class="active" href="">Home </i></a>
                                </li>
                                <li>
                                    <a href="{{route('about')}}">About Us</a>
                                </li>
                                <li>
                                    <a href="">Shop</a>
                                </li>

                                <li class="position-static">
                                    <a href="#">Browser Poster <i class="fi-rs-angle-down"></i></a>
                                    <ul class="mega-menu">
                                        <li class="sub-mega-menu sub-mega-menu-width-22">
                                            <a class="menu-title" href="#">Best poster</a>
                                            <ul>
                                                <li><a href="#">lorem plusam</a></li>
                                                <li><a href="#">lorem plusam</a></li>
                                                <li><a href="#">lorem plusam</a></li>
                                                <li><a href="#">lorem plusam</a></li>
                                                <li><a href="#">lorem plusam</a></li>
                                                <li><a href="#">lorem plusam</a></li>
                                            </ul>
                                        </li>
                                        <li class="sub-mega-menu sub-mega-menu-width-22">
                                            <a class="menu-title" href="#">old poster</a>
                                            <ul>
                                                <li><a href="">lorem plusam</a></li>
                                                <li><a href="">lorem plusam</a></li>
                                                <li><a href="">lorem plusam</a></li>
                                                <li><a href="">lorem plusam</a></li>
                                                <li><a href="">lorem plusamm</a></li>
                                                <li><a href="">lorem plusam</a></li>
                                            </ul>
                                        </li>
                                        <li class="sub-mega-menu sub-mega-menu-width-22">
                                            <a class="menu-title" href="#">Modren Poster</a>
                                            <ul>
                                                <li><a href="">lorem plusam</a></li>
                                                <li><a href="">lorem plusam</a></li>
                                                <li><a href="">lorem plusam</a></li>
                                                <li><a href="">lorem plusam</a></li>
                                                <li><a href="">lorem plusam</a></li>
                                                <li><a href="">lorem plusam</a></li>
                                            </ul>
                                        </li>
                                        <li class="sub-mega-menu sub-mega-menu-width-34">
                                            <div class="menu-banner-wrap">
                                                <a href="">
                                                    <img src="imgs/paint-g54d75202b_1920.jpg" alt="Nest" /></a>
                                                <div class="menu-banner-content">
                                                    <h4>Hot deals</h4>
                                                    <h3>
                                                        Don't miss<br />
                                                        Trending
                                                    </h3>
                                                    <div class="menu-banner-price">
                                                        <span class="new-price text-success">Save to 50%</span>
                                                    </div>
                                                    <div class="menu-banner-btn">
                                                        <a href="">Shop now</a>
                                                    </div>
                                                </div>
                                                <div class="menu-banner-discount">
                                                    <h3>
                                                        <span>25%</span>
                                                        off
                                                    </h3>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="blog-category-grid.html"> Discover Brand <i
                                            class="fi-rs-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="">Brand 1</a></li>
                                        <li><a href="">Brand 2</a></li>
                                        <li><a href="">Brand 3</a></li>
                                        <li><a href="">Brand 4</a></li>
                                        <li>
                                            <a href="#">Brand 5<i class="fi-rs-angle-right"></i></a>
                                            <ul class="level-menu level-menu-modify">
                                                <li><a href="">Brand </a></li>
                                                <li><a href="">RBrand </a></li>
                                                <li><a href="">Brand </a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Accessrios <i class="fi-rs-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="">Accessrios 1</a></li>
                                        <li><a href="">Accessrios </a></li>
                                        <li><a href="">Accessrios </a></li>
                                        <li><a href="">Accessrios </a></li>
                                        <li><a href="">Accessrios </a></li>
                                        <li><a href="">Accessrios </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('contact')}}">Contact Us</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>
                    <div class="header-action-right sticky-right-area">
                        <div class="header-action-2">
                            <div class="header-action-icon-2 sticky-serach">
                                <a href="javascript:void(0)" class="sticky-serach-btn">
                                    <i class="fi-rs-search"></i>
                                </a>
                                <div class="search-style-2 serac-pop">
                                    <form action="#">
                                        <input type="text" placeholder="Search for items...">
                                    </form>
                                </div>
                            </div>
                            <div class="header-action-icon-2">
                                <a href="">
                                    <img alt="Nest" src="imgs/theme/icons/icon-heart.svg" />
                                    <span class="pro-count white">4</span>
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="" href="#">
                                    <img alt="Nest" src="imgs/theme/icons/icon-cart.svg" />
                                    <span class="pro-count white">2</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href=""><img alt="Nest" src="imgs/shop/thumbnail-3.jpg" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="">Plain Striola Shirts</a></h4>
                                                <h3><span>1 × </span>$800.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href=""><img alt="Nest" src="imgs/shop/thumbnail-4.jpg" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="">lorem Pro 2022</a></h4>
                                                <h3><span>1 × </span>$3500.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$383.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="">View cart</a>
                                            <a href="shop-checkout.html">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="">
                                    <img alt="Nest" src="imgs/theme/icons/icon-heart.svg" />
                                    <span class="pro-count white">4</span>
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="" href="#">
                                    <img alt="Nest" src="imgs/theme/icons/icon-cart.svg" />
                                    <span class="pro-count white">2</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href=""><img alt="Nest" src="imgs/shop/thumbnail-3.jpg" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="">Plain Striola Shirts</a></h4>
                                                <h3><span>1 × </span>$800.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href=""><img alt="Nest" src="imgs/shop/thumbnail-4.jpg" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="">lorem Pro 2022</a></h4>
                                                <h3><span>1 × </span>$3500.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$383.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="">View cart</a>
                                            <a href="shop-checkout.html">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href=""><img src="imgs/logo.jpg" alt="logo" /></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="Search for items…" />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">

                            <li>
                                <a href=""><i class="fi fi-rs-user mr-10"></i>My Account</a>
                            </li>
                            <li>
                                <a href=""><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                            </li>
                            <li>
                                <a href=""><i class="fi fi-rs-label mr-10"></i>My Voucher</a>
                            </li>
                            <li>
                                <a href=""><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a>
                            </li>
                            <li>
                                <a href=""><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                            </li>
                            <li>
                                <a href=""><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                            </li>


                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap">
                    <div class="single-mobile-header-info">
                        <a href=""><i class="fi-rs-marker"></i> Our location </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href=""><i class="fi-rs-user"></i>Log In / Sign Up </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                    </div>
                </div>
                <div class="mobile-social-icon mb-50">
                    <h6 class="mb-15">Follow Us</h6>
                    <a href="#"><img src="imgs/theme/icons/icon-facebook-white.svg" alt="" /></a>
                    <a href="#"><img src="imgs/theme/icons/icon-twitter-white.svg" alt="" /></a>
                    <a href="#"><img src="imgs/theme/icons/icon-instagram-white.svg" alt="" /></a>
                    <a href="#"><img src="imgs/theme/icons/icon-pinterest-white.svg" alt="" /></a>
                    <a href="#"><img src="imgs/theme/icons/icon-youtube-white.svg" alt="" /></a>
                </div>
                <div class="site-copyright">Copyright 2022 © Nest. All rights reserved. Powered by AliThemes.</div>
            </div>
        </div>
    </div>

    <main class="main">
        @yield('content')
    </main>
    
    <footer class="main">
        <section class="newsletter mb-15 wow animate__animated animate__fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="position-relative newsletter-inner">
                            <div class="newsletter-content">
                                <h2 class="mb-20">
                                    Stay home & get your daily <br />
                                    needs
                                </h2>
                                <p class="mb-45">Start You'r Daily Shopping with <span class="text-brand">post
                                        priting</span></p>
                                <form class="form-subcriber d-flex">
                                    <input type="email" placeholder="Your emaill address" />
                                    <button class="btn" type="submit">Subscribe</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col">
                        <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp"
                            data-wow-delay="0">
                            <div class="logo mb-30">
                                <a href="" class="mb-15"><img src="imgs/logo.jpg" alt="logo" /></a>
                                <p class="font-lg text-heading">lore plusam dolor waht you can do ir gor </p>
                            </div>
                            <ul class="contact-infor">
                                <li><img src="imgs/theme/icons/icon-location.svg" alt="" /><strong>Address:
                                    </strong> <span>5171 W orem plusam dolor, lorem 53127 United States</span></li>
                                <li><img src="imgs/theme/icons/icon-contact.svg" alt="" /><strong>Call
                                        Us:</strong><span>(+91) - 123-123-124553</span></li>
                                <li><img src="imgs/theme/icons/icon-email-2.svg"
                                        alt="" /><strong>Email:</strong><span><a href="" class="__cf_email__"
                                            data-cfemail="">[email&#160;protected]</a></span></li>
                                <li><img src="imgs/theme/icons/icon-clock.svg"
                                        alt="" /><strong>Hours:</strong><span>10:00 - 18:00, Mon - Sat</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <h4 class=" widget-title">Company</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Delivery Information</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Support Center</a></li>
                            <li><a href="#">Careers</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <h4 class="widget-title">Account</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">Sign In</a></li>
                            <li><a href="#">View Cart</a></li>
                            <li><a href="#">My Wishlist</a></li>
                            <li><a href="#">Track My Order</a></li>
                            <li><a href="#">Help Ticket</a></li>
                            <li><a href="#">Shipping Details</a></li>
                            <li><a href="#">Compare products</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                        <h4 class="widget-title">Corporate</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">Become a Vendor</a></li>
                            <li><a href="#">Affiliate Program</a></li>
                            <li><a href="#">lorem Business</a></li>
                            <li><a href="#">lorem Careers</a></li>
                            <li><a href="#">Our Suppliers</a></li>
                            <li><a href="#">Accessibility</a></li>
                            <li><a href="#">Promotions</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget widget-install-app col wow animate__animated animate__fadeInUp"
                        data-wow-delay=".5s">
                        <h4 class="widget-title">Install App</h4>
                        <p class="">From App Store or Google Play</p>
                        <div class="download-app">
                            <a href="#" class="hover-up mb-sm-2 mb-lg-0"><img class="active"
                                    src="imgs/theme/app-store.jpg" alt="" /></a>
                            <a href="#" class="hover-up mb-sm-2"><img src="imgs/theme/google-play.jpg"
                                    alt="" /></a>
                        </div>
                        <p class="mb-20">Secured Payment Gateways</p>
                        <img class="" src="imgs/theme/payment-method.png" alt="" />
                    </div>
                </div>
        </section>
    </footer>
    <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="js/vendor/jquery-3.6.0.min.js"></script>
    <script src="js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.min.js"></script>
    <script src="js/plugins/slick.js"></script>
    <script src="js/plugins/jquery.syotimer.min.js"></script>
    <script src="js/plugins/waypoints.js"></script>
    <script src="js/plugins/wow.js"></script>
    <script src="js/plugins/perfect-scrollbar.js"></script>
    <script src="js/plugins/magnific-popup.js"></script>
    <script src="js/plugins/select2.min.js"></script>
    <script src="js/plugins/counterup.js"></script>
    <script src="js/plugins/jquery.countdown.min.js"></script>
    <script src="js/plugins/images-loaded.js"></script>
    <script src="js/plugins/isotope.js"></script>
    <script src="js/plugins/scrollup.js"></script>
    <script src="js/plugins/jquery.vticker-min.js"></script>
    <script src="js/plugins/jquery.theia.sticky.js"></script>
    <script src="js/plugins/jquery.elevatezoom.js"></script>
    <!-- Template  JS -->
    <script src="js/mainff29.js?v=5.5"></script>
    <script src="js/shopff29.js?v=5.5"></script>
    <script>
        $(".sticky-serach-btn").click(function () {
            $(".serac-pop").toggle();
        });
    </script>
</body>
</html>
