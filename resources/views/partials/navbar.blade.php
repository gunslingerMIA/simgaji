<nav class="top-navbar d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <button class="btn btn-light d-lg-none me-3" id="sidebarToggle">
            <i class="fa-solid fa-bars"></i>
        </button>
        <h4 class="mb-0 fw-bold text-dark">@yield('page_title', 'Dashboard')</h4>
    </div>
    
    <div class="d-flex align-items-center gap-3">
        <div class="dropdown">
            <button class="btn btn-light position-relative border-0 rounded-circle p-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-regular fa-bell fs-5 text-secondary"></i>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 p-0" style="width: 300px;">
                <li class="p-3 border-bottom"><h6 class="mb-0 fw-bold">Notifikasi Peringatan (EWS)</h6></li>
                <li><a class="dropdown-item py-2 border-bottom" href="#"><i class="fa-solid fa-circle-exclamation text-warning me-2"></i> 3 Anak mencapai usia 21 tahun</a></li>
                <li><a class="dropdown-item py-2" href="#"><i class="fa-solid fa-circle-info text-info me-2"></i> 5 Pegawai memasuki jadwal KGB</a></li>
                <li><a href="#" class="dropdown-item py-2 text-center text-primary fw-semibold bg-light">Lihat Semua</a></li>
            </ul>
        </div>
        
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name=Admin+Pengelola&background=3b82f6&color=fff&bold=true" alt="Admin" width="40" height="40" class="rounded-circle me-2 shadow-sm">
                <div class="d-none d-md-block text-start me-2">
                    <span class="d-block fw-bold" style="font-size: 0.9rem; line-height: 1;">Admin Pengelola</span>
                    <span class="text-muted" style="font-size: 0.75rem;">Operator Gaji Tunggal</span>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                <li><a class="dropdown-item py-2" href="#"><i class="fa-solid fa-user me-2 text-muted"></i> Profil Instansi</a></li>
                <li><a class="dropdown-item py-2" href="#"><i class="fa-solid fa-gear me-2 text-muted"></i> Pengaturan Aplikasi</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item py-2 text-danger" href="#"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Keluar</a></li>
            </ul>
        </div>
    </div>
</nav>
