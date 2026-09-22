@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 mt-5">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h4 class="mb-1 text-primary"><i class="fa-solid fa-cogs me-2"></i>Generate Gaji Induk PPPK Paruh Waktu</h4>
                    <p class="text-muted small mb-0">Hitung dan simpan data gaji PPPK Paruh Waktu untuk bulan tertentu.</p>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="fa-solid fa-circle-info fs-4 me-3"></i>
                        <div>
                            Proses ini akan mengambil data Pegawai PPPK Paruh Waktu aktif beserta keluarga, kemudian menghitung komponen Gaji Pokok, Tunjangan, Potongan, dan PPh. Data yang sudah ada di bulan yang sama akan ditimpa (replace).
                        </div>
                    </div>

                    <form action="{{ route('gaji-induk-PPPK Paruh Waktu-paruh-waktu.store') }}" method="POST" id="formGenerate">
                        @csrf
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="bulan" class="form-label fw-bold">Bulan</label>
                                <select name="bulan" id="bulan" class="form-select">
                                    @for($i = 1; $i <= 12; $i++)
                                        @php $m = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                                        <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>{{ $m }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tahun" class="form-label fw-bold">Tahun</label>
                                <select name="tahun" id="tahun" class="form-select">
                                    @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="umk" class="form-label fw-bold">UMK Tahun Berjalan (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" name="umk" id="umk" value="{{ $umk }}" required min="0">
                            </div>
                            <div class="form-text">Nilai ini digunakan sebagai batas minimum (floor) dasar perhitungan BPJS Kesehatan. Angka yang Anda masukkan akan diingat secara otomatis untuk form berikutnya.</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('gaji-induk-pppk-paruh-waktu.index') }}" class="btn btn-light border">
                                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.innerHTML='<i class=\'fa-solid fa-spinner fa-spin me-1\'></i> Memproses...';document.getElementById('formGenerate').submit();">
                                <i class="fa-solid fa-bolt me-1"></i> Mulai Generate
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
