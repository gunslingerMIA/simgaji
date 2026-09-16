@extends('layouts.app')

@section('title', 'Profil Pegawai')
@section('page_title', 'Profil Pegawai')

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}" class="text-decoration-none">Data Pegawai</a></li>
        <li class="breadcrumb-item active">Profil Pegawai</li>
    </ol>
</nav>

<div class="row g-4">
    {{-- Kolom Kiri: Profil Card --}}
    <div class="col-md-4 col-lg-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-4">
                {{-- Avatar --}}
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle fw-bold text-white"
                     style="width:80px;height:80px;font-size:28px;background:{{ $pegawai->jenis_kelamin === 'P' ? '#e91e63' : '#1976d2' }}">
                    {{ strtoupper(substr($pegawai->nama_lengkap, 0, 1)) }}{{ strtoupper(substr(explode(' ', $pegawai->nama_lengkap)[1] ?? $pegawai->nama_lengkap, 0, 1)) }}
                </div>

                <h6 class="fw-bold mb-1">
                    {{ $pegawai->gelar_depan ? $pegawai->gelar_depan . ' ' : '' }}{{ $pegawai->nama_lengkap }}{{ $pegawai->gelar_belakang ? ', ' . $pegawai->gelar_belakang : '' }}
                </h6>
                <div class="text-muted small mb-3">{{ $pegawai->nip }}</div>

                {{-- Badges --}}
                <div class="d-flex flex-wrap gap-1 justify-content-center mb-4">
                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">
                        {{ strtoupper(str_replace('_', ' ', $pegawai->status_kepegawaian)) }}
                    </span>
                    @if($pegawai->golongan)
                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25">
                        Gol. {{ $pegawai->golongan }}
                    </span>
                    @endif
                    @if($pegawai->is_active)
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">Aktif</span>
                    @else
                    <span class="badge bg-danger bg-opacity-10 text-danger">Non-Aktif</span>
                    @endif
                </div>

                {{-- Info Ringkas --}}
                <div class="text-start small">
                    <div class="mb-2">
                        <div class="text-muted fw-semibold">Jabatan</div>
                        <div>{{ $pegawai->jabatan ? $pegawai->jabatan->nama_jabatan : '-' }}</div>
                    </div>
                    <div class="mb-2">
                        <div class="text-muted fw-semibold">Masa Kerja Golongan (MKG) &amp; Gaji Pokok</div>
                        <div>{{ $pegawai->mkg_tahun }} Tahun {{ $pegawai->mkg_bulan }} Bulan</div>
                        <div class="fw-bold text-success">Rp {{ number_format($gajiPokok, 0, ',', '.') }}</div>
                    </div>
                    <div class="mb-2">
                        <div class="text-muted fw-semibold">Status Pernikahan / PTKP</div>
                        <div>{{ $pegawai->status_pernikahan }} / {{ $pegawai->ptkp_status }}</div>
                    </div>
                    <div class="mb-3">
                        <div class="text-muted fw-semibold">No. Rekening ({{ $pegawai->nama_bank }})</div>
                        <div>{{ $pegawai->nomor_rekening }} a.n {{ $pegawai->nama_pada_rekening }}</div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-grid gap-2">
                    <a href="{{ route('pegawai.kp4', $pegawai->id) }}" target="_blank" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-print me-1"></i> Cetak KP4
                    </a>
                    <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-warning btn-sm text-dark">
                        <i class="fa-solid fa-pen-to-square me-1"></i> Edit Data Utama
                    </a>
                    <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" class="delete-form">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                            <i class="fa-solid fa-trash me-1"></i> Hapus Pegawai
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Data Keluarga --}}
    <div class="col-md-8 col-lg-9">

        {{-- Data Pasangan --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <span class="fw-bold"><i class="fa-solid fa-user-group me-2 text-primary"></i>Data Pasangan (Suami/Istri)</span>
                @if($pegawai->status_kepegawaian !== 'pppk_paruh_waktu')
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPasanganModal">
                    <i class="fa-solid fa-plus me-1"></i> Tambah
                </button>
                @endif
            </div>
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Pasangan</th>
                            <th>NIK / Pekerjaan</th>
                            <th>Status Tunjangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pegawai->pasangan as $pasangan)
                        <tr>
                            <td><strong>{{ $pasangan->nama_pasangan }}</strong></td>
                            <td>
                                <div>{{ $pasangan->nik_pasangan }}</div>
                                <div class="small text-muted">{{ $pasangan->pekerjaan }}</div>
                            </td>
                            <td>
                                @if($pasangan->dapat_tunjangan)
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                        <i class="fa-solid fa-check me-1"></i>Dapat Tunjangan
                                    </span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">Tidak</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning me-1 edit-pasangan-btn" data-pasangan='@json($pasangan)'>
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('pegawai.pasangan.destroy', $pasangan->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Belum ada data pasangan terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Data Anak --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <span class="fw-bold"><i class="fa-solid fa-children me-2 text-info"></i>Data Anak</span>
                @if($pegawai->status_kepegawaian !== 'pppk_paruh_waktu')
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahAnakModal">
                    <i class="fa-solid fa-plus me-1"></i> Tambah
                </button>
                @endif
            </div>
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Anak Ke</th>
                            <th>Nama Anak / Status</th>
                            <th>Usia</th>
                            <th>Status Tunjangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pegawai->anak as $anak)
                        @php
                            $usia = $anak->tanggal_lahir ? \Carbon\Carbon::parse($anak->tanggal_lahir)->age : '-';
                        @endphp
                        <tr>
                            <td class="text-center fw-bold">{{ $anak->anak_ke }}</td>
                            <td>
                                <strong>{{ $anak->nama_anak }}</strong>
                                <div class="small text-muted">Anak {{ ucfirst($anak->status_anak) }} &bull; {{ $anak->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                            </td>
                            <td>{{ is_numeric($usia) ? $usia . ' tahun' : '-' }}</td>
                            <td>
                                @if($anak->dapat_tunjangan)
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                        <i class="fa-solid fa-check me-1"></i>Dapat Tunjangan
                                    </span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">Tidak</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning me-1 edit-anak-btn" data-anak='@json($anak)'>
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('pegawai.anak.destroy', $anak->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada data anak terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Pasangan --}}
<div class="modal fade" id="tambahPasanganModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title fw-bold">Tambah Data Pasangan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('pegawai.pasangan.store', $pegawai->id) }}" method="POST">
          @csrf
          <div class="modal-body">
              <div class="mb-3">
                  <label class="form-label fw-semibold">Nama Pasangan <span class="text-danger">*</span></label>
                  <input type="text" name="nama_pasangan" class="form-control" required>
              </div>
              <div class="row">
                  <div class="col-md-6 mb-3">
                      <label class="form-label fw-semibold">NIK Pasangan <span class="text-danger">*</span></label>
                      <input type="text" name="nik_pasangan" class="form-control" required maxlength="16">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label class="form-label fw-semibold">Pekerjaan <span class="text-danger">*</span></label>
                      <input type="text" name="pekerjaan" class="form-control" required>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4 mb-3">
                      <label class="form-label fw-semibold">Tempat Lahir</label>
                      <input type="text" name="tempat_lahir" class="form-control">
                  </div>
                  <div class="col-md-4 mb-3">
                      <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                      <input type="date" name="tanggal_lahir" class="form-control" required>
                  </div>
                  <div class="col-md-4 mb-3">
                      <label class="form-label fw-semibold">Tanggal Menikah <span class="text-danger">*</span></label>
                      <input type="date" name="tanggal_menikah" class="form-control" required>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6 mb-3">
                      <label class="form-label fw-semibold">NIP Pasangan (Jika PNS)</label>
                      <input type="text" name="nip_pasangan" class="form-control" placeholder="Kosongkan jika bukan PNS">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label class="form-label fw-semibold">No Buku Nikah</label>
                      <input type="text" name="nomor_buku_nikah" class="form-control">
                  </div>
              </div>
              <div class="form-check form-switch mt-2">
                  <input class="form-check-input" type="checkbox" role="switch" name="dapat_tunjangan" id="dapatTunjanganPasangan" value="1" checked>
                  <label class="form-check-label fw-semibold" for="dapatTunjanganPasangan">Aktifkan Tunjangan Suami/Istri (10%)</label>
              </div>
          </div>
          <div class="modal-footer border-top-0">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Pasangan</button>
          </div>
      </form>
    </div>
  </div>
</div>

{{-- Modal Edit Pasangan --}}
<div class="modal fade" id="editPasanganModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title fw-bold">Edit Data Pasangan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="formEditPasangan" method="POST">
          @csrf @method('PUT')
          <div class="modal-body">
              <div class="mb-3">
                  <label class="form-label fw-semibold">Nama Pasangan <span class="text-danger">*</span></label>
                  <input type="text" name="nama_pasangan" id="edit_nama_pasangan" class="form-control" required>
              </div>
              <div class="row">
                  <div class="col-md-6 mb-3">
                      <label class="form-label fw-semibold">NIK Pasangan <span class="text-danger">*</span></label>
                      <input type="text" name="nik_pasangan" id="edit_nik_pasangan" class="form-control" required maxlength="16">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label class="form-label fw-semibold">Pekerjaan <span class="text-danger">*</span></label>
                      <input type="text" name="pekerjaan" id="edit_pekerjaan_pasangan" class="form-control" required>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4 mb-3">
                      <label class="form-label fw-semibold">Tempat Lahir</label>
                      <input type="text" name="tempat_lahir" id="edit_tempat_lahir_pasangan" class="form-control">
                  </div>
                  <div class="col-md-4 mb-3">
                      <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                      <input type="date" name="tanggal_lahir" id="edit_tanggal_lahir_pasangan" class="form-control" required>
                  </div>
                  <div class="col-md-4 mb-3">
                      <label class="form-label fw-semibold">Tanggal Menikah <span class="text-danger">*</span></label>
                      <input type="date" name="tanggal_menikah" id="edit_tanggal_menikah_pasangan" class="form-control" required>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6 mb-3">
                      <label class="form-label fw-semibold">NIP Pasangan (Jika PNS)</label>
                      <input type="text" name="nip_pasangan" id="edit_nip_pasangan" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label class="form-label fw-semibold">No Buku Nikah</label>
                      <input type="text" name="nomor_buku_nikah" id="edit_nomor_buku_nikah_pasangan" class="form-control">
                  </div>
              </div>
              <div class="form-check form-switch mt-2">
                  <input class="form-check-input" type="checkbox" role="switch" name="dapat_tunjangan" id="edit_dapat_tunjangan_pasangan" value="1">
                  <label class="form-check-label fw-semibold" for="edit_dapat_tunjangan_pasangan">Aktifkan Tunjangan Suami/Istri (10%)</label>
              </div>
          </div>
          <div class="modal-footer border-top-0">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning">Update Pasangan</button>
          </div>
      </form>
    </div>
  </div>
</div>

{{-- Modal Tambah Anak --}}
<div class="modal fade" id="tambahAnakModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title fw-bold">Tambah Data Anak</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('pegawai.anak.store', $pegawai->id) }}" method="POST">
          @csrf
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-8 mb-3">
                      <label class="form-label fw-semibold">Nama Anak <span class="text-danger">*</span></label>
                      <input type="text" name="nama_anak" class="form-control" required>
                  </div>
                  <div class="col-md-4 mb-3">
                      <label class="form-label fw-semibold">Anak Ke- <span class="text-danger">*</span></label>
                      <input type="number" name="anak_ke" class="form-control" required min="1">
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-3 mb-3">
                      <label class="form-label fw-semibold">Status Anak <span class="text-danger">*</span></label>
                      <select name="status_anak" class="form-control" required>
                          <option value="kandung">Anak Kandung</option>
                          <option value="tiri">Anak Tiri</option>
                          <option value="angkat">Anak Angkat</option>
                      </select>
                  </div>
                  <div class="col-md-3 mb-3">
                      <label class="form-label fw-semibold">Tempat Lahir</label>
                      <input type="text" name="tempat_lahir" class="form-control">
                  </div>
                  <div class="col-md-3 mb-3">
                      <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                      <input type="date" name="tanggal_lahir" class="form-control" required>
                  </div>
                  <div class="col-md-3 mb-3">
                      <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                      <select name="jenis_kelamin" class="form-control" required>
                          <option value="L">Laki-laki</option>
                          <option value="P">Perempuan</option>
                      </select>
                  </div>
              </div>
              <div class="row mt-1">
                  <div class="col-md-4">
                      <div class="form-check mb-2">
                          <input class="form-check-input" type="checkbox" name="masih_kuliah" id="masihKuliah" value="1">
                          <label class="form-check-label" for="masihKuliah">Masih Kuliah (Usia 21-25 thn)</label>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-check mb-2">
                          <input class="form-check-input" type="checkbox" name="status_bekerja" id="statusBekerja" value="1">
                          <label class="form-check-label" for="statusBekerja">Sudah Punya Penghasilan</label>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-check mb-2">
                          <input class="form-check-input" type="checkbox" name="status_pernikahan" id="statusPernikahan" value="1">
                          <label class="form-check-label" for="statusPernikahan">Sudah Menikah</label>
                      </div>
                  </div>
              </div>
              <div class="row mt-1" id="kampusFields" style="display: none;">
                  <div class="col-md-8 mb-3">
                      <label class="form-label fw-semibold">Nama Kampus / Sekolah</label>
                      <input type="text" name="nama_kampus_sekolah" class="form-control">
                  </div>
                  <div class="col-md-4 mb-3">
                      <label class="form-label fw-semibold">Tgl Exp. Surat Kuliah</label>
                      <input type="date" name="tgl_surat_kuliah_expired" class="form-control">
                  </div>
              </div>
              <div class="form-check form-switch mt-3 pt-3 border-top">
                  <input class="form-check-input" type="checkbox" role="switch" name="dapat_tunjangan" id="dapatTunjanganAnak" value="1" checked>
                  <label class="form-check-label fw-semibold" for="dapatTunjanganAnak">Aktifkan Tunjangan Anak (2%)</label>
              </div>
          </div>
          <div class="modal-footer border-top-0">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Anak</button>
          </div>
      </form>
    </div>
  </div>
</div>

{{-- Modal Edit Anak --}}
<div class="modal fade" id="editAnakModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title fw-bold">Edit Data Anak</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="formEditAnak" method="POST">
          @csrf @method('PUT')
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-8 mb-3">
                      <label class="form-label fw-semibold">Nama Anak <span class="text-danger">*</span></label>
                      <input type="text" name="nama_anak" id="edit_nama_anak" class="form-control" required>
                  </div>
                  <div class="col-md-4 mb-3">
                      <label class="form-label fw-semibold">Anak Ke- <span class="text-danger">*</span></label>
                      <input type="number" name="anak_ke" id="edit_anak_ke" class="form-control" required min="1">
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-3 mb-3">
                      <label class="form-label fw-semibold">Status Anak <span class="text-danger">*</span></label>
                      <select name="status_anak" id="edit_status_anak" class="form-control" required>
                          <option value="kandung">Anak Kandung</option>
                          <option value="tiri">Anak Tiri</option>
                          <option value="angkat">Anak Angkat</option>
                      </select>
                  </div>
                  <div class="col-md-3 mb-3">
                      <label class="form-label fw-semibold">Tempat Lahir</label>
                      <input type="text" name="tempat_lahir" id="edit_tempat_lahir_anak" class="form-control">
                  </div>
                  <div class="col-md-3 mb-3">
                      <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                      <input type="date" name="tanggal_lahir" id="edit_tanggal_lahir_anak" class="form-control" required>
                  </div>
                  <div class="col-md-3 mb-3">
                      <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                      <select name="jenis_kelamin" id="edit_jenis_kelamin_anak" class="form-control" required>
                          <option value="L">Laki-laki</option>
                          <option value="P">Perempuan</option>
                      </select>
                  </div>
              </div>
              <div class="row mt-1">
                  <div class="col-md-4">
                      <div class="form-check mb-2">
                          <input class="form-check-input" type="checkbox" name="masih_kuliah" id="edit_masih_kuliah" value="1">
                          <label class="form-check-label" for="edit_masih_kuliah">Masih Kuliah (Usia 21-25 thn)</label>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-check mb-2">
                          <input class="form-check-input" type="checkbox" name="status_bekerja" id="edit_status_bekerja" value="1">
                          <label class="form-check-label" for="edit_status_bekerja">Sudah Punya Penghasilan</label>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-check mb-2">
                          <input class="form-check-input" type="checkbox" name="status_pernikahan" id="edit_status_pernikahan" value="1">
                          <label class="form-check-label" for="edit_status_pernikahan">Sudah Menikah</label>
                      </div>
                  </div>
              </div>
              <div class="row mt-1" id="editKampusFields" style="display: none;">
                  <div class="col-md-8 mb-3">
                      <label class="form-label fw-semibold">Nama Kampus / Sekolah</label>
                      <input type="text" name="nama_kampus_sekolah" id="edit_nama_kampus_sekolah" class="form-control">
                  </div>
                  <div class="col-md-4 mb-3">
                      <label class="form-label fw-semibold">Tgl Exp. Surat Kuliah</label>
                      <input type="date" name="tgl_surat_kuliah_expired" id="edit_tgl_surat_kuliah_expired" class="form-control">
                  </div>
              </div>
              <div class="form-check form-switch mt-3 pt-3 border-top">
                  <input class="form-check-input" type="checkbox" role="switch" name="dapat_tunjangan" id="edit_dapat_tunjangan_anak" value="1">
                  <label class="form-check-label fw-semibold" for="edit_dapat_tunjangan_anak">Aktifkan Tunjangan Anak (2%)</label>
              </div>
          </div>
          <div class="modal-footer border-top-0">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning">Update Anak</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle kampus fields (Tambah Anak)
        document.getElementById('masihKuliah').addEventListener('change', function() {
            document.getElementById('kampusFields').style.display = this.checked ? 'flex' : 'none';
        });

        // Toggle kampus fields (Edit Anak)
        const editMasihKuliah = document.getElementById('edit_masih_kuliah');
        const editKampusFields = document.getElementById('editKampusFields');
        editMasihKuliah.addEventListener('change', function() {
            editKampusFields.style.display = this.checked ? 'flex' : 'none';
        });

        // Edit Pasangan
        document.querySelectorAll('.edit-pasangan-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                let data = JSON.parse(this.getAttribute('data-pasangan'));
                document.getElementById('formEditPasangan').action = '/pegawai/{{ $pegawai->id }}/pasangan/' + data.id;
                document.getElementById('edit_nama_pasangan').value = data.nama_pasangan ?? '';
                document.getElementById('edit_tempat_lahir_pasangan').value = data.tempat_lahir ?? '';
                document.getElementById('edit_nik_pasangan').value = data.nik_pasangan ?? '';
                document.getElementById('edit_pekerjaan_pasangan').value = data.pekerjaan ?? '';
                document.getElementById('edit_tanggal_lahir_pasangan').value = data.tanggal_lahir ? data.tanggal_lahir.substring(0, 10) : '';
                document.getElementById('edit_tanggal_menikah_pasangan').value = data.tanggal_menikah ? data.tanggal_menikah.substring(0, 10) : '';
                document.getElementById('edit_nip_pasangan').value = data.nip_pasangan ?? '';
                document.getElementById('edit_nomor_buku_nikah_pasangan').value = data.nomor_buku_nikah ?? '';
                document.getElementById('edit_dapat_tunjangan_pasangan').checked = !!data.dapat_tunjangan;
                new bootstrap.Modal(document.getElementById('editPasanganModal')).show();
            });
        });

        // Edit Anak
        document.querySelectorAll('.edit-anak-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                let data = JSON.parse(this.getAttribute('data-anak'));
                document.getElementById('formEditAnak').action = '/pegawai/{{ $pegawai->id }}/anak/' + data.id;
                document.getElementById('edit_nama_anak').value = data.nama_anak ?? '';
                document.getElementById('edit_anak_ke').value = data.anak_ke ?? '';
                document.getElementById('edit_status_anak').value = data.status_anak ?? '';
                document.getElementById('edit_tempat_lahir_anak').value = data.tempat_lahir ?? '';
                document.getElementById('edit_tanggal_lahir_anak').value = data.tanggal_lahir ? data.tanggal_lahir.substring(0, 10) : '';
                document.getElementById('edit_jenis_kelamin_anak').value = data.jenis_kelamin ?? '';
                document.getElementById('edit_masih_kuliah').checked = !!data.masih_kuliah;
                document.getElementById('edit_status_bekerja').checked = !!data.status_bekerja;
                document.getElementById('edit_status_pernikahan').checked = !!data.status_pernikahan;
                document.getElementById('edit_nama_kampus_sekolah').value = data.nama_kampus_sekolah ?? '';
                document.getElementById('edit_tgl_surat_kuliah_expired').value = data.tgl_surat_kuliah_expired ? data.tgl_surat_kuliah_expired.substring(0, 10) : '';
                editKampusFields.style.display = data.masih_kuliah ? 'flex' : 'none';
                document.getElementById('edit_dapat_tunjangan_anak').checked = !!data.dapat_tunjangan;
                new bootstrap.Modal(document.getElementById('editAnakModal')).show();
            });
        });

        // SweetAlert Konfirmasi Hapus
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    });
</script>
@endpush
