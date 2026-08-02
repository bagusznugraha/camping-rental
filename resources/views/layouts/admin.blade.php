<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CampRent Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        body{
            background:#f5f6fa;
        }

        .sidebar{
            width:260px;
            min-height:100vh;
            background:#212529;
        }

        .sidebar .nav-link{
            color:#fff;
            border-radius:8px;
            margin-bottom:5px;
            padding:12px 15px;
            transition:.2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active{
            background:#198754;
            color:#fff;
        }

        .logo{
            font-size:20px;
            font-weight:bold;
        }

    </style>

</head>

<body>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar text-white p-3 shadow">

        <h3 class="text-center mb-4 logo">

            🏕 CampRent

        </h3>

        <hr class="text-secondary">

        <ul class="nav flex-column">

            <li class="nav-item mb-2">

                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                    <i class="bi bi-speedometer2 me-2"></i>

                    Dashboard

                </a>

            </li>

            <li class="nav-item mb-2">

                <a href="{{ route('categories.index') }}"
                   class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">

                    <i class="bi bi-folder me-2"></i>

                    Kategori

                </a>

            </li>

            <li class="nav-item mb-2">

                <a href="{{ route('equipment.index') }}"
                   class="nav-link {{ request()->routeIs('equipment.*') ? 'active' : '' }}">

                    <i class="bi bi-backpack2 me-2"></i>

                    Alat Camping

                </a>

            </li>

            <li class="nav-item mb-2">

                <a href="{{ route('rentals.index') }}"
                   class="nav-link {{ request()->routeIs('rentals.*') ? 'active' : '' }}">

                    <i class="bi bi-cart-check me-2"></i>

                    Penyewaan

                </a>

            </li>

            <li class="nav-item mb-2">
    <a href="{{ route('returns.index') }}"
       class="nav-link {{ request()->routeIs('returns.*') ? 'active' : '' }}">
        <i class="bi bi-arrow-return-left me-2"></i>
        Pengembalian
    </a>
</li>

<li class="nav-item mb-2">
    <a href="{{ route('customers.index') }}"
       class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
        <i class="bi bi-person-badge me-2"></i>
        Data Pelanggan
    </a>
</li>

<li class="nav-item mb-2">
    <a href="{{ route('visitors.index') }}"
       class="nav-link {{ request()->routeIs('visitors.*') ? 'active' : '' }}">
        <i class="bi bi-person-walking me-2"></i>
        Data Pengunjung
    </a>
</li>
                

                <li class="nav-item">
    <a href="{{ route('users.index') }}" class="nav-link">
        👥 Data User
    </a>
</li>

            </li>

            <li class="nav-item mb-2">

                <a href="{{ route('reports.index') }}"
                   class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">

                    <i class="bi bi-file-earmark-bar-graph me-2"></i>

                    Laporan

                </a>

            </li>

            <hr class="text-secondary">

            <li class="nav-item mb-2">

                <a href="{{ route('profile.edit') }}"
                   class="nav-link">

                    <i class="bi bi-person-circle me-2"></i>

                    Profil

                </a>

            </li>

            <li class="nav-item mt-3">

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button class="btn btn-danger w-100">

                        <i class="bi bi-box-arrow-right me-1"></i>

                        Logout

                    </button>

                </form>

            </li>

        </ul>

    </div>

    <!-- Content -->
    <div class="flex-grow-1">

        <nav class="navbar navbar-light bg-white shadow-sm">

            <div class="container-fluid">

                <h4 class="mb-0">

                    Dashboard Admin

                </h4>

                <div>

                    Selamat Datang,

                    <strong>{{ auth()->user()->name }}</strong>

                </div>

            </div>

        </nav>

        <div class="container py-4">

            @yield('content')

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>