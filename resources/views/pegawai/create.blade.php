@extends('layouts.app')

@section('title', 'Tambah Pegawai')
@section('page_title', 'Tambah Data Pegawai')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold">Tambah Pegawai Baru</h4>
        <p class="text-muted mb-0">Isi data pegawai dengan lengkap dan benar.</p>
    </div>
    <a href="{{ route('pegawai.index') }}" class="btn btn-light border"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
</div>

<form action="{{ route('pegawai.store') }}" method="POST">
    @csrf

    {{-- Identitas Pegawai --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-bottom fw-bold py-3">
            <i class="fa-solid fa-id-card me-2 text-primary"></i>Identitas Pegawai
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">NIP <span class="text-danger">*</span></label>
                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" required maxlength="50">
                    @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Gelar Depan</label>
                    <input type="text" name="gelar_depan" class="form-control" value="{{ old('gelar_depan') }}" maxlength="50">
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap') }}" required maxlength="255">
                    @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Gelar Belakang</label>
                    <input type="text" name="gelar_belakang" class="form-control" value="{{ old('gelar_belakang') }}" maxlength="50">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                    <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" required maxlength="16">
                    @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" maxlength="100">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Agama</label>
                    <select name="agama" class="form-select">
                        <option value="">-- Pilih --</option>
                        @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $ag)
                        <option value="{{ $ag }}" {{ old('agama') == $ag ? 'selected' : '' }}>{{ $ag }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2">{{ old('alamat') }}</textarea>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Status Pernikahan <span class="text-danger">*</span></label>
                    <select name="status_pernikahan" class="form-select @error('status_pernikahan') is-invalid @enderror" required>
                        <option value="TK" {{ old('status_pernikahan') == 'TK' ? 'selected' : '' }}>Tidak Kawin (TK)</option>
                        <option value="K/0" {{ old('status_pernikahan') == 'K/0' ? 'selected' : '' }}>Kawin - 0 tanggungan</option>
                        <option value="K/1" {{ old('status_pernikahan') == 'K/1' ? 'selected' : '' }}>Kawin - 1 tanggungan</option>
                        <option value="K/2" {{ old('status_pernikahan') == 'K/2' ? 'selected' : '' }}>Kawin - 2 tanggungan</option>
                        <option value="K/3" {{ old('status_pernikahan') == 'K/3' ? 'selected' : '' }}>Kawin - 3 tanggungan</option>
                    </select>
                    @error('status_pernikahan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Status PTKP <span class="text-danger">*</span></label>
                    <select name="ptkp_status" class="form-select" required>
                        @foreach(['TK/0','TK/1','TK/2','TK/3','K/0','K/1','K/2','K/3','K/I/0','K/I/1','K/I/2','K/I/3'] as $ptkp)
                        <option value="{{ $ptkp }}" {{ old('ptkp_status') == $ptkp ? 'selected' : '' }}>{{ $ptkp }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- Kepegawaian --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-bottom fw-bold py-3">
            <i class="fa-solid fa-briefcase me-2 text-primary"></i>Data Kepegawaian
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Status Kepegawaian <span class="text-danger">*</span></label>
                    <select name="status_kepegawaian" id="statusKepegawaian" class="form-select" required>
                        <option value="pns" {{ old('status_kepegawaian') == 'pns' ? 'selected' : '' }}>PNS</option>
                        <option value="cpns" {{ old('status_kepegawaian') == 'cpns' ? 'selected' : '' }}>CPNS</option>
                        <option value="pppk" {{ old('status_kepegawaian') == 'pppk' ? 'selected' : '' }}>PPPK</option>
                        <option value="pppk_paruh_waktu" {{ old('status_kepegawaian') == 'pppk_paruh_waktu' ? 'selected' : '' }}>PPPK Paruh Waktu</option>
                    </select>
                </div>
                <div class="col-md-3" id="golonganField">
                    <label class="form-label fw-semibold">Golongan</label>
                    <input type="text" name="golongan" class="form-control" value="{{ old('golongan') }}" maxlength="10" placeholder="Contoh: III/a">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">MKG Tahun</label>
                    <input type="number" name="mkg_tahun" class="form-control" value="{{ old('mkg_tahun', 0) }}" min="0">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">MKG Bulan</label>
                    <input type="number" name="mkg_bulan" class="form-control" value="{{ old('mkg_bulan', 0) }}" min="0" max="11">
                </div>
                <div class="col-md-2" id="gajiKontrakField" style="display: none;">
                    <label class="form-label fw-semibold">Gaji Kontrak (Rp)</label>
                    <input type="number" name="gaji_kontrak" class="form-control" value="{{ old('gaji_kontrak') }}" min="0">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jabatan <span class="text-danger">*</span></label>
                    <select name="ref_jabatan_id" id="refJabatanId" class="form-select @error('ref_jabatan_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach($jabatans as $jabatan)
                        <option value="{{ $jabatan->id }}" {{ old('ref_jabatan_id') == $jabatan->id ? 'selected' : '' }}>{{ $jabatan->nama_jabatan }} ({{ strtoupper($jabatan->jenis_jabatan) }})</option>
                        @endforeach
                    </select>
                    @error('ref_jabatan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3" id="tmtCpnsField">
                    <label class="form-label fw-semibold">TMT CPNS</label>
                    <input type="date" name="tmt_cpns" class="form-control" value="{{ old('tmt_cpns') }}">
                </div>
                <div class="col-md-3" id="tmtPnsField">
                    <label class="form-label fw-semibold">TMT PNS</label>
                    <input type="date" name="tmt_pns" class="form-control" value="{{ old('tmt_pns') }}">
                </div>
                <div class="col-md-3" id="tmtPangkatField">
                    <label class="form-label fw-semibold">TMT Pangkat Terakhir</label>
                    <input type="date" name="tmt_pangkat_terakhir" class="form-control" value="{{ old('tmt_pangkat_terakhir') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">TMT KGB Terakhir</label>
                    <input type="date" name="tmt_kgb_terakhir" class="form-control" value="{{ old('tmt_kgb_terakhir') }}">
                </div>
            </div>
        </div>
    </div>

    {{-- Rekening --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-bottom fw-bold py-3">
            <i class="fa-solid fa-building-columns me-2 text-primary"></i>Data Rekening Bank
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Nomor Rekening <span class="text-danger">*</span></label>
                    <input type="text" name="nomor_rekening" class="form-control @error('nomor_rekening') is-invalid @enderror" value="{{ old('nomor_rekening') }}" required>
                    @error('nomor_rekening') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4" id="namaBankField">
                    <label class="form-label fw-semibold">Bank <span class="text-danger">*</span></label>
                    <select name="nama_bank" class="form-select" required>
                        <option value="Bank Jateng" {{ old('nama_bank') == 'Bank Jateng' ? 'selected' : '' }}>Bank Jateng</option>
                        <option value="Bank Pekalongan" {{ old('nama_bank') == 'Bank Pekalongan' ? 'selected' : '' }}>Bank Pekalongan</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Nama Pada Rekening <span class="text-danger">*</span></label>
                    <input type="text" name="nama_pada_rekening" class="form-control @error('nama_pada_rekening') is-invalid @enderror" value="{{ old('nama_pada_rekening') }}" required>
                    @error('nama_pada_rekening') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" name="is_active" id="isActive" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="isActive">Pegawai Aktif</label>
        </div>
        <div class="ms-auto d-flex gap-2">
            <a href="{{ route('pegawai.index') }}" class="btn btn-light border">Batal</a>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i> Simpan Pegawai</button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusEl = document.getElementById('statusKepegawaian');

    function updateFields() {
        const val = statusEl.value;
        const isPns = val === 'pns';
        const isCpns = val === 'cpns';
        const isPppk = val === 'pppk';
        const isParuhWaktu = val === 'pppk_paruh_waktu';

        document.getElementById('golonganField').style.display = isParuhWaktu ? 'none' : 'block';
        document.getElementById('gajiKontrakField').style.display = isParuhWaktu ? 'block' : 'none';
        document.getElementById('tmtCpnsField').style.display = (isPns || isCpns) ? 'block' : 'none';
        document.getElementById('tmtPnsField').style.display = isPns ? 'block' : 'none';
        document.getElementById('tmtPangkatField').style.display = (isPns || isPppk) ? 'block' : 'none';
    }

    statusEl.addEventListener('change', updateFields);
    updateFields();
});
</script>
@endpush
