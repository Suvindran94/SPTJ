<!DOCTYPE html>
<html
lang="en"
class="light-style layout-menu-fixed"
dir="ltr"
data-theme="theme-default"
data-assets-path="../assetsadmin/"
data-template="vertical-menu-template-free">
<head>
<meta charset="utf-8" />
<meta
name="viewport"
content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
<title>Sistem Pengurusan Temu Janji dan Giliran Klinik ENT</title>
<meta name="description" content="" />
<link rel="icon" type="image/x-icon" href="{{ asset('Logo.png') }}" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
rel="stylesheet" />
<style>
.dataTable td,
th {
text-align: left !important;
}
</style>
<link rel="stylesheet" href="{{ asset('assetsadmin/vendor/fonts/boxicons.css') }}" />
<link rel="stylesheet" href="{{ asset('assetsadmin/vendor/css/core.css') }}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('assetsadmin/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('assetsadmin/css/demo.css') }}" />
<link rel="stylesheet" href="{{ asset('assetsadmin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<script src="{{ asset('assetsadmin/vendor/js/helpers.js') }}"></script>
<script src="{{ asset('assetsadmin/js/config.js') }}"></script>
</head>

<body>
<div class="layout-wrapper layout-content-navbar">
<div class="layout-container">
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
<div class="app-brand demo">
<a href="/adminhome" class="app-brand-link">
    <span class="app-brand-logo demo">
        <img src="{{ asset('Logo.png') }}" style="width:auto; height:50px;">

    </span>
</a>
<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
    <i class="bx bx-chevron-left bx-sm align-middle"></i>
</a>
</div>

<div class="menu-inner-shadow"></div>

<ul class="menu-inner py-1">
<li class="menu-item @if($page == 'bilik') active @endif">
    <a href="/adminhome" class="menu-link">
        <i class="menu-icon tf-icons bx bx-building-house"></i>
        <div data-i18n="Pengurusan Bilik">Pengurusan Bilik</div>
    </a>
</li>

<li class="menu-item @if($page == 'staff') active @endif">
    <a href="/staff" class="menu-link">
        <i class="menu-icon tf-icons bx bx-id-card"></i>
        <div data-i18n="Pengurusan Staff">Pengurusan Staff</div>
    </a>
</li>

<li class="menu-item @if($page == 'doctor') active @endif">
    <a href="/doctor" class="menu-link">
        <i class="menu-icon tf-icons bx bx-plus-medical"></i>
        <div data-i18n="Pengurusan Doctor">Pengurusan Doctor</div>
    </a>
</li>

<li class="menu-item @if($page == 'logs') active @endif">
    <a href="/loginlogs" class="menu-link">
        <i class="menu-icon tf-icons bx bx-file-find"></i>
        <div data-i18n="Log Pengguna">Log Pengguna</div>
    </a>
</li>
</ul>
</aside>
<div class="layout-page">
<nav
class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar">
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
    </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">


    <ul class="navbar-nav flex-row align-items-center ms-auto">

        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    <img src="{{ asset('user.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-online">
                                    <img src="{{ asset('user.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                                <small class="text-muted">{{ auth()->user()->role }}</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="/logout">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</div>
</nav>