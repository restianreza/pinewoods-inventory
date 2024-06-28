<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="{{ route('dashboard') }}" class="navbar-brand mx-4 mb-3">
            <h6 class="text-primary">PINEWOODS INVENTORY</h6>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('assets') }}/img/user.png" alt=""
                    style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                <span>{{ auth()->user()->role }}</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('dashboard') }}" class="nav-item nav-link active"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="bi-shop me-2"></i>Tim Depan</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <div class="nav-item dropdwond ms-4">
                        <a href="{{ route('showcase') }}" class="dropdown-item">Show Case</a>
                        <a href="{{ route('perlengkapan-depan') }}" class="dropdown-item">Perlengkapan Depan</a>
                    </div>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="bi-cup me-2"></i>Bar</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <div class="nav-item dropdwond ms-4">
                        <a href="{{ route('bahan-bar') }}" class="dropdown-item">Bahan Bar</a>
                        <a href="{{ route('perlengkapan-bar') }}" class="dropdown-item">Perlengkapan Bar</a>
                    </div>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="bi-basket me-2"></i>Kitchen</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <div class="nav-item dropdwond ms-4">
                        <a href="{{ route('dry-good') }}" class="dropdown-item">Dry Good</a>
                        <a href="{{ route('froozen-food') }}" class="dropdown-item">Frozen Food</a>
                        <a href="{{ route('perlengkapan-dapur') }}" class="dropdown-item">Perlengkapan Dapur</a>
                    </div>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="bi-bucket me-2"></i>Cleaning Serv</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <div class="nav-item dropdown ms-4">
                        <a href="{{ route('perlengkapan-indoor') }}" class="dropdown-item">Perlengkapan Indoor</a>
                        <a href="{{ route('perlengkapan-outdoor') }}" class="dropdown-item">Perlengkapan
                            Outdoor</a>
                        <a href="{{ route('perlengkapan-area-luar') }}" class="dropdown-item">Perlengkapan Area
                            Luar</a>
                        <a href="{{ route('perlengkapan-wc') }}" class="dropdown-item">Perlengkapan Wc</a>
                        <a href="{{ route('bahan-cs') }}" class="dropdown-item">Bahan</a>
                    </div>
                </div>
            </div>

            @if (auth()->user()->role === 'superadmin')
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi-collection me-2"></i>More</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <div class="nav-item dropdown ms-4">
                            <a href="{{ route('history') }}" class="dropdown-item">Riwayat</a>
                            <a href="{{ route('categories') }}" class="dropdown-item">Kategori</a>
                            <a href="{{ route('user') }}" class="dropdown-item">User management</a>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </nav>
</div>
<!-- Sidebar End -->
