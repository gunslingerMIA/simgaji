@extends('layouts.app')

@section('title', 'Pagu Anggaran')
@section('page_title', 'Master Pagu Anggaran')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    .subkegiatan-card {
        border: 2px solid transparent;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
    }
    .subkegiatan-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.10)!important;
    }
    .subkegiatan-card.active {
        border-color: #0d6efd;
        background-color: #f8faff;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <!-- Header Controls & Filter Tahun -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3 d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h4 class="mb-1 fw-bold text-dark"><i class="fa-solid fa-sack-dollar text-primary me-2"></i>Pagu Anggaran Tahun {{ $tahun }}</h4>
                <p class="text-muted small mb-0">Kelola dan pantau alokasi pagu anggaran belanja pegawai berdasarkan Sub Kegiatan.</p>
            </div>
            
            <div class="d-flex flex-wrap align-items-center gap-2">
                <!-- Filter Tahun -->
                <form action="{{ route('pagu-anggaran.index') }}" method="GET" class="d-flex align-items-center">
                    <input type="hidden" name="sub_kegiatan" value="{{ $selectedSub }}">
                    <label for="tahun" class="me-2 fw-semibold small text-muted">Tahun:</label>
                    <select name="tahun" id="tahun" class="form-select form-select-sm w-auto fw-bold" onchange="this.form.submit()">
                        @php $currentYear = date('Y'); @endphp
                        @for($y = $currentYear - 2; $y <= $currentYear + 2; $y++)
                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </form>
                
                <button type="button" class="btn btn-primary btn-sm px-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Rekening Belanja
                </button>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check fs-5 me-2"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fa-solid fa-triangle-exclamation fs-5 me-2"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- KPI Summary Overview -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-white border-0 shadow-sm p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 bg-primary bg-opacity-10 p-3 text-primary me-3">
                        <i class="fa-solid fa-file-invoice-dollar fa-xl"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-semibold">Pagu Penetapan (Murni)</div>
                        <div class="fs-5 fw-bold text-dark">Rp {{ number_format($totalPenetapan, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-white border-0 shadow-sm p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 bg-info bg-opacity-10 p-3 text-info me-3">
                        <i class="fa-solid fa-shuffle fa-xl"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-semibold">Pagu Pergeseran</div>
                        <div class="fs-5 fw-bold text-dark">Rp {{ number_format($totalPergeseran, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-white border-0 shadow-sm p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 bg-success bg-opacity-10 p-3 text-success me-3">
                        <i class="fa-solid fa-vault fa-xl"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-semibold">Pagu Perubahan (Aktif)</div>
                        <div class="fs-5 fw-bold text-success">Rp {{ number_format($totalPerubahan, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-white border-0 shadow-sm p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 bg-warning bg-opacity-10 p-3 text-warning me-3">
                        <i class="fa-solid fa-list-check fa-xl"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-semibold">Total Rekening Belanja</div>
                        <div class="fs-5 fw-bold text-dark">{{ count($paguAnggaran) }} Rekening</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sub Kegiatan List Cards / Tabs -->
    <div class="row g-3 mb-4">
        <!-- Sub Kegiatan 1 -->
        @php
            $sub1 = $subKegiatanList['2.18.01.2.02.0001'] ?? [
                'kode' => '2.18.01.2.02.0001',
                'nama' => 'Penyediaan Gaji dan Tunjangan ASN',
                'count' => 0,
                'perubahan' => 0
            ];
            $sub2 = $subKegiatanList['2.18.01.2.08.0004'] ?? [
                'kode' => '2.18.01.2.08.0004',
                'nama' => 'Penyediaan Jasa Pelayanan Umum Kantor',
                'count' => 0,
                'perubahan' => 0
            ];
        @endphp
        
        <div class="col-md-6">
            <a href="{{ route('pagu-anggaran.index', ['tahun' => $tahun, 'sub_kegiatan' => '2.18.01.2.02.0001']) }}" class="text-decoration-none">
                <div class="card shadow-sm subkegiatan-card {{ $selectedSub === '2.18.01.2.02.0001' ? 'active' : '' }} p-3 h-100">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary fw-bold font-monospace px-2 py-1">
                            <i class="fa-solid fa-folder-tree me-1"></i> 2.18.01.2.02.0001
                        </span>
                        <span class="badge bg-secondary rounded-pill px-2.5 py-1">
                            {{ $sub1['count'] }} Rekening
                        </span>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Penyediaan Gaji dan Tunjangan ASN</h6>
                    <p class="text-muted small mb-2">Gaji Pokok, Tunjangan Keluarga, Jabatan, Beras, BPJS, dan TPP (PNS & PPPK).</p>
                    <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                        <span class="text-muted small">Total Pagu Perubahan:</span>
                        <span class="fw-bold text-success fs-6">Rp {{ number_format($sub1['perubahan'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- Sub Kegiatan 2 -->
        <div class="col-md-6">
            <a href="{{ route('pagu-anggaran.index', ['tahun' => $tahun, 'sub_kegiatan' => '2.18.01.2.08.0004']) }}" class="text-decoration-none">
                <div class="card shadow-sm subkegiatan-card {{ $selectedSub === '2.18.01.2.08.0004' ? 'active' : '' }} p-3 h-100">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-success bg-opacity-10 text-success fw-bold font-monospace px-2 py-1">
                            <i class="fa-solid fa-folder-tree me-1"></i> 2.18.01.2.08.0004
                        </span>
                        <span class="badge bg-secondary rounded-pill px-2.5 py-1">
                            {{ $sub2['count'] }} Rekening
                        </span>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Penyediaan Jasa Pelayanan Umum Kantor</h6>
                    <p class="text-muted small mb-2">Belanja Jasa PPPK Paruh Waktu & Iuran Jaminan Sosial (Kesehatan, JKK, JKM, JHT).</p>
                    <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                        <span class="text-muted small">Total Pagu Perubahan:</span>
                        <span class="fw-bold text-success fs-6">Rp {{ number_format($sub2['perubahan'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom p-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div class="d-flex align-items-center gap-2">
                <div class="btn-group">
                    <a href="{{ route('pagu-anggaran.index', ['tahun' => $tahun, 'sub_kegiatan' => 'all']) }}" 
                       class="btn btn-sm {{ $selectedSub === 'all' ? 'btn-dark' : 'btn-outline-secondary' }}">
                        <i class="fa-solid fa-layer-group me-1"></i> Semua Sub Kegiatan ({{ count($paguAnggaran) }})
                    </a>
                    <a href="{{ route('pagu-anggaran.index', ['tahun' => $tahun, 'sub_kegiatan' => '2.18.01.2.02.0001']) }}" 
                       class="btn btn-sm {{ $selectedSub === '2.18.01.2.02.0001' ? 'btn-primary' : 'btn-outline-primary' }}">
                        <i class="fa-solid fa-user-tie me-1"></i> Gaji & Tunjangan ASN ({{ $sub1['count'] }})
                    </a>
                    <a href="{{ route('pagu-anggaran.index', ['tahun' => $tahun, 'sub_kegiatan' => '2.18.01.2.08.0004']) }}" 
                       class="btn btn-sm {{ $selectedSub === '2.18.01.2.08.0004' ? 'btn-success' : 'btn-outline-success' }}">
                        <i class="fa-solid fa-user-clock me-1"></i> PPPK Paruh Waktu & Jasa ({{ $sub2['count'] }})
                    </a>
                </div>
            </div>

            <span class="badge bg-light text-dark border px-3 py-2">
                <i class="fa-solid fa-filter text-primary me-1"></i> Menampilkan: 
                <strong>
                    @if($selectedSub === 'all')
                        Semua Sub Kegiatan
                    @elseif($selectedSub === '2.18.01.2.02.0001')
                        2.18.01.2.02.0001 - Penyediaan Gaji dan Tunjangan ASN
                    @elseif($selectedSub === '2.18.01.2.08.0004')
                        2.18.01.2.08.0004 - Penyediaan Jasa Pelayanan Umum Kantor
                    @else
                        {{ $selectedSub }}
                    @endif
                </strong>
            </span>
        </div>
        
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle w-100" id="tablePagu" style="font-size: 0.9em;">
                    <thead class="table-light align-middle text-center">
                        <tr>
                            <th width="3%">No</th>
                            @if($selectedSub === 'all')
                                <th width="15%">Sub Kegiatan</th>
                            @endif
                            <th width="14%">Kode Rekening</th>
                            <th>Uraian Rekening Belanja</th>
                            <th width="13%">Penetapan (Rp)</th>
                            <th width="13%">Pergeseran (Rp)</th>
                            <th width="13%" class="bg-success bg-opacity-10 text-success">Perubahan (Rp)</th>
                            <th width="8%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paguAnggaran as $index => $pagu)
                        <tr>
                            <td class="text-center text-muted">{{ $index + 1 }}</td>
                            @if($selectedSub === 'all')
                                <td class="small">
                                    <span class="badge bg-light text-dark border font-monospace">{{ $pagu->kode_sub_kegiatan }}</span>
                                    <div class="text-muted" style="font-size: 0.8em;">{{ $pagu->nama_sub_kegiatan }}</div>
                                </td>
                            @endif
                            <td class="fw-bold font-monospace text-primary">{{ $pagu->kode_rekening }}</td>
                            <td>{{ $pagu->uraian }}</td>
                            <td class="text-end font-monospace">{{ number_format($pagu->pagu_penetapan, 0, ',', '.') }}</td>
                            <td class="text-end font-monospace">{{ number_format($pagu->pagu_pergeseran, 0, ',', '.') }}</td>
                            <td class="text-end font-monospace text-success fw-bold bg-success bg-opacity-10">
                                {{ number_format($pagu->pagu_perubahan, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary edit-btn" 
                                            data-id="{{ $pagu->id }}" 
                                            data-kodesub="{{ $pagu->kode_sub_kegiatan }}"
                                            data-namasub="{{ $pagu->nama_sub_kegiatan }}"
                                            data-kode="{{ $pagu->kode_rekening }}"
                                            data-uraian="{{ $pagu->uraian }}"
                                            data-penetapan="{{ $pagu->pagu_penetapan }}"
                                            data-pergeseran="{{ $pagu->pagu_pergeseran }}"
                                            data-perubahan="{{ $pagu->pagu_perubahan }}"
                                            data-tahun="{{ $pagu->tahun }}"
                                            title="Edit Rekening Belanja">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <form action="{{ route('pagu-anggaran.destroy', $pagu->id) }}" method="POST" class="d-inline form-delete-pagu">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-outline-danger btn-delete-pagu" data-uraian="{{ $pagu->uraian }}" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ $selectedSub === 'all' ? 8 : 7 }}" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-inbox fa-3x text-secondary mb-2 d-block"></i>
                                Belum ada rekening belanja untuk sub kegiatan ini pada tahun {{ $tahun }}.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if(count($paguAnggaran) > 0)
                    <tfoot class="table-light fw-bold text-end">
                        <tr>
                            <td colspan="{{ $selectedSub === 'all' ? 4 : 3 }}" class="text-center">TOTAL KESELURUHAN</td>
                            <td class="font-monospace">Rp {{ number_format($paguAnggaran->sum('pagu_penetapan'), 0, ',', '.') }}</td>
                            <td class="font-monospace">Rp {{ number_format($paguAnggaran->sum('pagu_pergeseran'), 0, ',', '.') }}</td>
                            <td class="font-monospace text-success bg-success bg-opacity-10 fs-6">Rp {{ number_format($paguAnggaran->sum('pagu_perubahan'), 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <div class="modal-header border-bottom pb-3">
        <h5 class="modal-title fw-bold"><i class="fa-solid fa-circle-plus text-primary me-2"></i>Tambah Rekening Belanja Pagu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('pagu-anggaran.store') }}" method="POST">
          @csrf
          <div class="modal-body">
              <input type="hidden" name="tahun" value="{{ $tahun }}">
              
              <div class="mb-3">
                  <label class="form-label fw-semibold">Sub Kegiatan <span class="text-danger">*</span></label>
                  <select name="kode_sub_kegiatan" id="createSubKegiatan" class="form-select" required>
                      <option value="2.18.01.2.02.0001" {{ $selectedSub === '2.18.01.2.02.0001' ? 'selected' : '' }}>
                          2.18.01.2.02.0001 - Penyediaan Gaji dan Tunjangan ASN
                      </option>
                      <option value="2.18.01.2.08.0004" {{ $selectedSub === '2.18.01.2.08.0004' ? 'selected' : '' }}>
                          2.18.01.2.08.0004 - Penyediaan Jasa Pelayanan Umum Kantor
                      </option>
                  </select>
              </div>

              <div class="row mb-3">
                  <div class="col-md-5">
                      <label class="form-label fw-semibold">Kode Rekening <span class="text-danger">*</span></label>
                      <input type="text" name="kode_rekening" class="form-control font-monospace" required placeholder="Contoh: 5.1.01.01.001.00001">
                  </div>
                  <div class="col-md-7">
                      <label class="form-label fw-semibold">Uraian Rekening Belanja <span class="text-danger">*</span></label>
                      <input type="text" name="uraian" class="form-control" required placeholder="Contoh: Belanja Gaji Pokok PNS">
                  </div>
              </div>

              <div class="row mb-2">
                  <div class="col-md-4">
                      <label class="form-label fw-semibold">Pagu Penetapan (Rp)</label>
                      <input type="number" name="pagu_penetapan" class="form-control text-end font-monospace" required min="0" value="0">
                  </div>
                  <div class="col-md-4">
                      <label class="form-label fw-semibold">Pergeseran (Rp)</label>
                      <input type="number" name="pagu_pergeseran" class="form-control text-end font-monospace" required min="0" value="0">
                  </div>
                  <div class="col-md-4">
                      <label class="form-label fw-semibold">Pagu Perubahan (Rp)</label>
                      <input type="number" name="pagu_perubahan" class="form-control text-end font-monospace fw-bold text-success" required min="0" value="0">
                  </div>
              </div>
          </div>
          <div class="modal-footer border-top pt-2">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary fw-semibold"><i class="fa-solid fa-save me-1"></i> Simpan Rekening</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <div class="modal-header border-bottom pb-3">
        <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-to-square text-primary me-2"></i>Edit Rekening Belanja Pagu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">
              <input type="hidden" name="tahun" id="editTahun">
              <input type="hidden" name="active_sub" value="{{ $selectedSub }}">
              
              <div class="mb-3">
                  <label class="form-label fw-semibold">Sub Kegiatan <span class="text-danger">*</span></label>
                  <select name="kode_sub_kegiatan" id="editSubKegiatan" class="form-select" required>
                      <option value="2.18.01.2.02.0001">2.18.01.2.02.0001 - Penyediaan Gaji dan Tunjangan ASN</option>
                      <option value="2.18.01.2.08.0004">2.18.01.2.08.0004 - Penyediaan Jasa Pelayanan Umum Kantor</option>
                  </select>
              </div>

              <div class="row mb-3">
                  <div class="col-md-5">
                      <label class="form-label fw-semibold">Kode Rekening <span class="text-danger">*</span></label>
                      <input type="text" name="kode_rekening" id="editKode" class="form-control font-monospace" required>
                  </div>
                  <div class="col-md-7">
                      <label class="form-label fw-semibold">Uraian Rekening Belanja <span class="text-danger">*</span></label>
                      <input type="text" name="uraian" id="editUraian" class="form-control" required>
                  </div>
              </div>

              <div class="row mb-2">
                  <div class="col-md-4">
                      <label class="form-label fw-semibold">Pagu Penetapan (Rp)</label>
                      <input type="number" name="pagu_penetapan" id="editPenetapan" class="form-control text-end font-monospace" required min="0">
                  </div>
                  <div class="col-md-4">
                      <label class="form-label fw-semibold">Pergeseran (Rp)</label>
                      <input type="number" name="pagu_pergeseran" id="editPergeseran" class="form-control text-end font-monospace" required min="0">
                  </div>
                  <div class="col-md-4">
                      <label class="form-label fw-semibold">Pagu Perubahan (Rp)</label>
                      <input type="number" name="pagu_perubahan" id="editPerubahan" class="form-control text-end font-monospace fw-bold text-success" required min="0">
                  </div>
              </div>
          </div>
          <div class="modal-footer border-top pt-2">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary fw-semibold"><i class="fa-solid fa-save me-1"></i> Simpan Perubahan</button>
          </div>
      </form>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTables
        if ($('#tablePagu tbody tr').length > 0 && !$('#tablePagu tbody tr td').hasClass('dataTables_empty')) {
            $('#tablePagu').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                },
                responsive: true,
                pageLength: 25,
                order: []
            });
        }

        // Edit Button Handler
        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
        
        $(document).on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            let kodeSub = $(this).data('kodesub') || '2.18.01.2.02.0001';
            let kode = $(this).data('kode');
            let uraian = $(this).data('uraian');
            let penetapan = $(this).data('penetapan');
            let pergeseran = $(this).data('pergeseran');
            let perubahan = $(this).data('perubahan');
            let tahun = $(this).data('tahun');

            $('#editSubKegiatan').val(kodeSub);
            $('#editKode').val(kode);
            $('#editUraian').val(uraian);
            $('#editPenetapan').val(penetapan);
            $('#editPergeseran').val(pergeseran);
            $('#editPerubahan').val(perubahan);
            $('#editTahun').val(tahun);

            // Set Form Action Route
            let actionUrl = '/pagu-anggaran/' + id;
            $('#editForm').attr('action', actionUrl);

            editModal.show();
        });

        // Delete confirmation with SweetAlert2
        $(document).on('click', '.btn-delete-pagu', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            let uraian = $(this).data('uraian');

            Swal.fire({
                title: 'Hapus Rekening Belanja?',
                html: `Apakah Anda yakin ingin menghapus rekening belanja:<br><b>${uraian}</b>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fa-solid fa-trash me-1"></i> Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
