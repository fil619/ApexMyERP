<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Apex MyERP</title>

        <!-- CSRF Stuff -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

    </head>
    <body>
        <div class="nav-bar">
            <div class="hamburger" id="hamburger">
                <div class="slice one"></div>
                <div class="slice two"></div>
                <div class="slice three"></div>
            </div>
            <div class="brand">Apex MyERP <small>v2.0</small></div>
            <div class="nav-menu">
                <ul>
                    <li>
                        <a onClick="showSubNav()" title="Notification"><i class="far fa-envelope"></i><span class="notification-count">2</span></a>
                        <div class="sub-nav-menu">
                            <div class="notification">
                                <span class="notification-origin">Inventory</span>
                                <span class="notification-title">Brakes are out of stock.</span>
                                <span class="notification-description">Just 8 brakes are remaining. Bought from Sunshine Automobiles</span>
                            </div>
                            <div class="notification">
                                <span class="notification-origin">Inventory</span>
                                <span class="notification-title">Spark Plug's are out of stock.</span>
                                <span class="notification-description">Just 8 brakes are remaining. Bought from Sunshine Automobiles</span>
                            </div>
                        </div>
                    </li>
                    <li><a href="#" title="Settings"><i class="fas fa-sliders-h"></i></a></li>
                    <li><a href="#" title="Logout"><i class="fas fa-power-off"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="wrapper" id="app">
            <div class="wrapper-sidebar">
                <div class="side-menu">
                    <div class="side-item" id="home">
                        <!-- <a href="#home" class="side-btn"><i class="fas fa-home"></i><span class="side-item-title">Home</span></a> -->
                        <router-link to="/home" class="side-btn"><i class="fas fa-chart-line"></i><span class="side-item-title">Overview <small>[F1]</small></span></router-link>
                    </div>
                    <div class="side-item" id="home">
                        <router-link to="/calendar" class="side-btn"><i class="fas fa-chart-line"></i><span class="side-item-title">Calendar</span></router-link>
                    </div>
                    <div class="side-item" id="billing">
                        <a href="#billing" class="side-btn"><i class="fas fa-file-invoice-dollar"></i><span class="side-item-title">Billing</span></a>
                        <div class="side-sub-menu">
                            <!-- <a href="#"><i class="fas fa-motorcycle"></i><span class="side-item-title">Servicing</span></a> -->
                            <router-link to="/servicing"><i class="fas fa-tools"></i><span class="side-item-title">Servicing</span></router-link>
                            <router-link to="/spare-part"><i class="fas fa-oil-can"></i><span class="side-item-title">Spare Part</span></router-link>
                            <router-link to="/counter-sale"><i class="fas fa-cash-register"></i><span class="side-item-title">Counter Sale</span></router-link>
                            <router-link to="/outstanding-bill"><i class="far fa-clock"></i><span class="side-item-title">Outstanding</span></router-link>
                            <router-link to="/search-bill"><i class="fas fa-search-dollar"></i><span class="side-item-title">Search</span></router-link>
                            <router-link to="/customer"><i class="fas fa-user-tie"></i><span class="side-item-title">Customer</span></router-link>
                        </div>
                    </div>
                    <div class="side-item" id="employee">
                        <a href="#employee" class="side-btn"><i class="fas fa-user-cog"></i><span class="side-item-title">Employee</span></a>
                        <div class="side-sub-menu">
                          <router-link to="/createusers"><i class="fas fa-user-tie"></i><span class="side-item-title">Add</span></router-link>
                          <router-link to="/editusers"><i class="fas fa-user-tie"></i><span class="side-item-title">Edit</span></router-link>
                          <router-link to="/Report"><i class="fas fa-user-tie"></i><span class="side-item-title">Report</span></router-link>
                          <router-link to="/Attendance"><i class="fas fa-user-tie"></i><span class="side-item-title">Attendance</span></router-link>
                          <router-link to="/Advance"><i class="fas fa-user-tie"></i><span class="side-item-title">Advance Deduction</span></router-link>
                          <router-link to="/Addtnpayment"><i class="fas fa-user-tie"></i><span class="side-item-title">Additional Payments</span></router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper-container">
                <router-view></router-view>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            $(document).ready(function(){
                var height = $(window).height() - $('.nav-bar').height() + 'px';
                //$('.wrapper-sidebar').height(height);
                $('.wrapper-sidebar').css('min-height',height);

                if($(window).width()>1024){
                    $('#hamburger').addClass('active');
                    $('.wrapper-sidebar').addClass('sidebar-active');
                }

                $(window).on('resize',function(){
                    var height = $(window).height() - $('.nav-bar').height() + 'px';
                    //$('.wrapper-sidebar').height(height);
                    $('.wrapper-sidebar').css('min-height',height);

                    if($(window).width()>1024){
                        $('#hamburger').addClass('active');
                        $('.wrapper-sidebar').addClass('sidebar-active');
                    } else{
                        $('#hamburger').removeClass('active');
                        $('.wrapper-sidebar').removeClass('sidebar-active');
                    }
                });

                $('#hamburger').click(function(){
                    $('#hamburger').toggleClass('active');
                    $('.wrapper-sidebar').toggleClass('sidebar-active');
                });

                var under = 0;
                var i = 0;

                $(document).on('keydown',function(e){
                    if(e.which>111 && e.which<122){
                        e.preventDefault();
                        if(under){
                            if(e.which === under){
                                i++;
                            } else{
                                i=0;
                            }
                        }
                    }

                    var key = e.which;
                    if(key == 112){
                        $('#home a')[0].click();
                    } else if(key == 113){
                        $('#billing a')[0].click();
                        if(i<6){
                            $('#billing .side-sub-menu a')[i].focus();
                        } else {
                            i = 0;
                            $('#billing .side-sub-menu a')[i].focus();
                        }
                        under = key;
                    } else if(key == 114){
                        $('#employee a')[0].click();
                        if(i<6){
                            $('#employee .side-sub-menu a')[i].focus();
                        } else {
                            i = 0;
                            $('#employee .side-sub-menu a')[i].focus();
                        }
                        under = key;
                    }

                    //alert(String.fromCharCode(e.which));
                });
            });

            function showSubNav(){
                if(document.getElementsByClassName("sub-nav-menu").item(0).style.transform == 'scale(1)'){
                    $('.sub-nav-menu').css('transform', 'scale(0)');
                } else {
                    $('.sub-nav-menu').css('transform', 'scale(1)');
                }
            }
        </script>
    </body>
</html>
