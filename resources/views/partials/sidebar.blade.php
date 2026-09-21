<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <i class="fa-solid fa-wallet text-primary"></i>
        <span>APP-GAJI</span>
    </div>

    <ul class="nav flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>
        </li>
        
        <div class="menu-header">Data Master</div>
        <li class="nav-item">
            <a href="{{ route('pegawai.index') }}" class="nav-link {{ request()->is('pegawai*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i>
                Data Pegawai
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('jabatan.index') }}" class="nav-link {{ request()->is('jabatan*') ? 'active' : '' }}">
                <i class="fa-solid fa-sitemap"></i>
                Jabatan & Kelas
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('referensi-gaji.index') }}" class="nav-link {{ request()->is('referensi-gaji*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-invoice-dollar"></i>
                Referensi Gaji
            </a>
        </li>

        <div class="menu-header">Payroll Proses</div>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-money-check-dollar"></i>
                Gaji Induk Bulanan
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-hand-holding-dollar"></i>
                Tambahan Penghasilan (TPP)
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-gifts"></i>
                Gaji 13 & 14 (THR)
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Rapel Gaji
            </a>
        </li>

        <div class="menu-header">Integrasi & Laporan</div>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-building-columns"></i>
                Bank Jateng CMS
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('cetak-kp4.index') }}" class="nav-link {{ request()->is('cetak-kp4*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-pdf"></i>
                Cetak KP4
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-file-invoice"></i>
                Pajak 1721-A2
            </a>
        </li>
        <li class="nav-item mt-3">
            <a href="#" class="nav-link text-warning border border-warning border-opacity-25 bg-warning bg-opacity-10">
                <i class="fa-solid fa-bell"></i>
                Early Warning System
            </a>
        </li>
    </ul>
</div>
