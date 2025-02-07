<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Drafting KAK - BAKTI</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: ["simple-line-icons"],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Load Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.navbar_user')
        <!-- End Sidebar -->

        <div class="main-panel">
            {{-- @include('layouts.header_user') --}}
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="light-blue">
                        <a href="{{ route('user.index') }}" class="logo">
                            <img src="{{ asset('assets/img/kaiadmin/logo_bakti_light.svg') }}" alt="navbar brand"
                                class="navbar-brand" height="60" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                </div>
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#">
                                    <div class="avatar-sm">
                                        <img src="{{ asset('assets/img/user.png') }}" alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Welcome,</span>
                                        <span class="fw-bold" id="username">Loading....</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="u-text">
                                                    <h4>{{ Auth::user()->username ?? 'Guest' }}</h4>
                                                    <p class="text-muted">{{ Auth::user()->email ?? '' }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('user.faq') }}">FAQ</a>
                                            <a class="dropdown-item" href="#"
                                                onclick="logoutConfirm(event)">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Dashboard Staff</h3>
                        </div>
                    </div>
                    <div class="row">
                        <!-- First row with three cards -->

                        <div class="col-sm-4 col-md-4">
                            <div class="card card-stats card-round card-compact">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                                <i class="fas fa-hourglass-half"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Pending</p>
                                                <h4 class="card-title">{{ $totalPending }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="card card-stats card-round card-compact">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Disetujui</p>
                                                <h4 class="card-title">{{ $totalDisetujui }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="card card-stats card-round card-compact">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-danger bubble-shadow-small">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Ditolak</p>
                                                <h4 class="card-title">{{ $totalDitolak }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 justify-content-center">
                        <!-- Second row with two centered cards -->
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round card-compact">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                                <i class="fa-sharp fa-solid fa-clipboard-list"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <a href="" style="text-decoration: none; color: inherit;">
                                                <div class="numbers">
                                                    <p class="card-category">Daftar KAK</p>
                                                    <h4 class="card-title">{{ $totalDaftar }}</h4>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round card-compact">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <i class="fas fa-file-alt"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Draft</p>
                                                <h4 class="card-title">{{ $totalDraft }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>

    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", async function() {
            let token = localStorage.getItem("token");

            console.log("Token yang dikirim:", token); // Debugging token

            if (!token) {
                Swal.fire({
                    icon: 'error',
                    title: 'Session Expired!',
                    text: 'Your session has expired, please login again.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = "/login";
                });
                return;
            }

            try {
                let response = await fetch("/api/me", {
                    method: "GET",
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Accept": "application/json"
                    }
                });

                let data = await response.json();
                console.log("Data user:", data); // Debugging data user

                if (response.ok) {
                    document.getElementById("username").textContent = data.username;
                } else {
                    console.log("Response status:", response.status);
                    localStorage.removeItem("token");
                    Swal.fire({
                        icon: 'error',
                        title: 'Access Denied!',
                        text: 'You do not have permission to access this page.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = "/login";
                    });
                }
            } catch (error) {
                console.error("Fetch error:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error!',
                    text: 'Unable to fetch user data. Please try again later.',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>



    <script>
        function logoutConfirm(event) {
            event.preventDefault(); // Mencegah aksi default

            Swal.fire({
                title: 'Are you sure you want to logout?',
                text: "You will be logged out of the system.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let token = localStorage.getItem("token");

                    if (!token) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Logout Failed!',
                            text: 'You are not logged in.',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    try {
                        let response = await fetch("/api/logout", {
                            method: "POST",
                            headers: {
                                "Authorization": `Bearer ${token}`,
                                "Content-Type": "application/json"
                            }
                        });

                        if (response.ok) {
                            localStorage.removeItem("token"); // Hapus token dari localStorage
                            Swal.fire({
                                icon: 'success',
                                title: 'Logged Out!',
                                text: 'You have successfully logged out.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = "/login?status=logout"; // Redirect ke login
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Logout Failed!',
                                text: 'Failed to logout, please try again.',
                                confirmButtonText: 'OK'
                            });
                        }
                    } catch (error) {
                        console.error("Error:", error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Logout Error!',
                            text: 'An error occurred while logging out.',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        }
    </script>


</body>

</html>
