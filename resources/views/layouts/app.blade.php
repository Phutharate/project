<!DOCTYPE html>
<html lang="en">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<head>
    <meta charset="UTF-8">
    <title>User</title>
    
    <!-- Bootstrap & AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
</head>



{{-- dashboard.blade.php หรือ layout --}}
@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: '{{ session('success') }}',
                confirmButtonText: 'ตกลง',
                timer: 3000,
                timerProgressBar: true
            });
        });
    </script>
@endif


    <!-- Scripts -->
    @yield('scripts')
</body>
</html>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard') }}" class="nav-link">Home</a>

                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link">
                <span class="brand-text font-weight-light" style="font-size: 37px;">Anamai</span>
            </a>
            

            <!-- Sidebar -->
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user-profiles.create') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar"></i>
                                <p>จองรถราชการ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user-profiles.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>รายการจอง</p>
                            </a>
                        </li>
                        <li class="nav-item mt-auto">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link text-danger btn btn-link"
                                    style="color: inherit; text-align: left; padding: 0;">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>ออกจากระบบ</p>
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @yield('content') {{-- ตรงนี้จะแสดงเนื้อหาของแต่ละหน้า --}}
        </div>

    </div>

    <!-- JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    @stack('scripts') {{-- สำหรับหน้าอื่น ๆ ที่อยากเพิ่ม script เพิ่มเติม --}}
</body>

</html>
