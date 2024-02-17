<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Dashboard | {{Config::get('constants.app_title')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    
        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/admin/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/admin/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/css/admin/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
            <!-- Confirm Css-->
        <link href="{{ asset('assets/css/admin/confirm.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        
        <style>
            .dataTables_paginate {float: left;}
            .dataTables_filter {float: left;}
            .dataTables_length {float: right;}
            .dataTables_info {float:right;}
        </style>
    </head>

    <body data-sidebar="dark">
        <!-- <body data-layout="horizontal" data-topbar="colored"> -->

            <!-- Begin page -->
            <div id="layout-wrapper">

                <header id="page-topbar">
                    <div class="navbar-header">
                        <div class="d-flex">
                            <!-- LOGO -->
                            <div class="navbar-brand-box">
                                <a href="dashboard" class="logo logo-dark">
                                    <span class="logo-sm">
                                        <img src="{{ asset('assets/images/logo-dark-sm.png') }}" alt="" height="22">
                                    </span>
                                    <span class="logo-lg">
                                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="18">
                                    </span>
                                </a>
                
                                <a href="dashboard" class="logo logo-light">
                                    <span class="logo-sm">
                                        <img src="{{ asset('assets/images/logo-light-sm.png') }}" alt="" height="22">
                                    </span>
                                    <span class="logo-lg">
                                        <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="18">
                                    </span>
                                </a>
                            </div>

                            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                                <i class="fa fa-fw fa-bars"></i>
                            </button>
                        </div>

                        
                            