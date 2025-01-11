<?php
session_start();
include '../penilaian/Widgets/badge.php';
include '../penilaian/Widgets/Auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SPK Penilaian Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../penilaian/main.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar fixed-top navbar-expand-lg">
                <div class="container-fluid">
                    <button class="btn btn-primary d-lg-none overflow-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive">
                        <i class="bi bi-menu-button-wide"> </i>Menu
                    </button>
                    <a class="navbar-brand mx-lg-2" href="../penilaian/page.php?q=home"><button class="btn btn-sm btn-info text-white">SPK Karyawan</button> </a>
                    <img src="your_logo.png.png" alt="" height="20px">
                </div>
            </nav>
            <aside class="bd-sidebar col col-12 col-sm-12 col-lg-2 h-100vh pt-3">
                <div class="">
                    <div class="offcanvas-lg offcanvas-start pt-lg-5 mt-lg-3 m-lg-2" tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasResponsiveLabel">
                                <i class="bi bi-menu-button-wide"> </i>Menu
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <nav class="bd-links w-100" id="bd-docs-nav" aria-label="Docs navigation">
                                <p class="d-inline-flex gap-1">
                                    <a href="../penilaian/page.php?q=home">
                                        <button class="btn btn-primary" style="min-width: 150px;" type="button">
                                            <i class="bi bi-speedometer"> </i>Dashboard
                                        </button>
                                    </a>
                                </p>
                                <p class="d-inline-flex gap-1">
                                    <a href="../penilaian/page.php?q=karyawanView">
                                        <button class="btn btn-primary" style="min-width: 150px;" type="button">
                                            <i class="bi bi-people"> </i>Karyawan
                                        </button>
                                    </a>
                                </p>
                                <p class="d-inline-flex gap-1">
                                    <a href="../penilaian/page.php?q=kriteriaView">
                                        <button class="btn btn-primary" style="min-width: 150px;" type="button">
                                            <i class="bi bi-tags"> </i>Kriteria
                                        </button>
                                    </a>
                                </p>
                                <p class="d-inline-flex gap-1">
                                    <a href="../penilaian/page.php?q=penilaianView">
                                        <button class="btn btn-primary" style="min-width: 150px;" type="button">
                                            <i class="bi bi-calculator"> </i>Penilaian
                                        </button>
                                    </a>
                                </p>
                                <p class="d-inline-flex gap-1">
                                    <a href="../penilaian/page.php?q=rankView">
                                        <button class="btn btn-primary" style="min-width: 150px;" type="button">
                                            <i class="bi bi-bar-chart-line"> </i>Perhitungan
                                        </button>
                                    </a>
                                </p>
                                <p class="d-inline-flex gap-1">
                                    <a href="../penilaian/page.php?q=logout"><button class="btn btn-danger" style="min-width: 150px;">Logout</button></a>
                                </p>
                            </nav>
                        </div>
                    </div>
                </div>
            </aside>

            <main class="main col col-sm-11 col-lg-9 p-lg-0">
                <div class="pt-5">