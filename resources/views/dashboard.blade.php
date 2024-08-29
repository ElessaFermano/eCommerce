<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/css/user.css') }}">
    <script>
        const accessToken = localStorage.getItem('access_token');
        if (!accessToken) {
            window.location.href = "/";
        }
        fetch("/api/user", {
            method: "GET",
            headers: {
                Authorization: 'Bearer ' + accessToken,
            }
        }).then(response => response.json())
        .then(response => {
            if (response.role !== 'admin') {
                window.location.href = "/";
            }
        });
    </script>
</head>
<body>
    <div class="container-scroller">
        
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                    </div>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/dashboard">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/users">
                        <span class="menu-icon">
                            <i class="mdi mdi-contacts"></i>
                        </span>
                        <span class="menu-title">Users</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/categories">
                        <span class="menu-icon">
                            <i class="mdi mdi-playlist-play"></i>
                        </span>
                        <span class="menu-title">Categories</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/products">
                        <span class="menu-icon">
                            <i class="mdi mdi-table-large"></i>
                        </span>
                        <span class="menu-title">Products</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/orders">
                        <span class="menu-icon">
                            <i class="mdi mdi-chart-bar"></i>
                        </span>
                        <span class="menu-title">Orders</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/shipping">
                        <span class="menu-icon">
                            <i class="mdi mdi-truck"></i>
                        </span>
                        <span class="menu-title">Shipping Fees</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/reviews">
                        <span class="menu-icon">
                            <i class="mdi mdi-star"></i>
                        </span>
                        <span class="menu-title">Reviews</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/suppliers">
                        <span class="menu-icon">
                            <i class="mdi mdi-cash-multiple"></i>
                        </span>
                        <span class="menu-title">Suppliers</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/inventory">
                        <span class="menu-icon">
                            <i class="mdi mdi-cube"></i>
                        </span>
                        <span class="menu-title">Inventory</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="container-fluid page-body-wrapper">
           
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                 
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav navbar-nav-right">
                       
                        <li class="nav-item dropdown d-none d-lg-block">
                            @php
                            use App\Models\Notification;
                            $notifications = Notification::orderBy('created_at', 'desc')->take(5)->get();
                            @endphp
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                                <i class="mdi mdi-bell"></i>
                                @if ($notifications->count())
                                    <div class="count"> {{ " ". $notifications->count() }}</div>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                <h6 class="p-3 mb-0">Notifications</h6>
                                <div class="dropdown-divider"></div>
                                @foreach ($notifications as $notification)
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-dark rounded-circle">
                                                <i class="mdi mdi-calendar text-success"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <h6 class="preview-subject mb-1">{{ $notification->message }}</h6>
                                            <p class="text-muted mb-0">{{ $notification->created_at->format('d M Y, h:i A') }}</p>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                @endforeach
                                @if ($notifications->isEmpty())
                                    <a class="dropdown-item text-center">No notifications</a>
                                @endif
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                                <div class="navbar-profile">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name" id="userRole"> </p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" onclick="logout()">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Log out</p>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body py-0 px-0 px-sm-3">
                                    <div class="row align-items-center">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            fetch('/api/user', {
                method: 'GET',
                headers:{
                    Authorization: 'Bearer ' +localStorage.getItem('access_token'),
                    Accept : 'application/json',
                }
            }).then(response => response.json())
            .then(response => {
                if(response)
            {
                document.getElementById('userRole').innerHTML = response.role;
            }
            })
        })


        function logout() {
            swal({
                title: "Are you sure you want to logout?",
                icon: "warning",
                buttons: ["Cancel", "Logout"],
                dangerMode: true,
            })
            .then((ifLogout) => {
                if (ifLogout) {
                    localStorage.removeItem('access_token');
                    localStorage.removeItem('user_id');
                    localStorage.removeItem('current_id');
                    window.location.href = '/';
                } else {
                    window.location.href = '/dashboard';
                }
            });
        }
    </script>
  
    <script src={{asset("js/sweetalert.min.js")}}></script>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/misc.js"></script>
    
</body>
</html>
