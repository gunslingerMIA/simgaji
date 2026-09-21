@extends('layouts.app')

@section('title', 'Master Data Jabatan & Kelas')
@section('page_title', 'Master Data Jabatan & Kelas Jabatan')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    .badge-soft-primary { background-color: #e0edff; color: #0d6efd; }
    .badge-soft-success { background-color: #d1f2d9; color: #198754; }
    .badge-soft-warning { background-color: #fff3cd; color: #b78103; }
    .badge-soft-secondary { background-color: #f1f2f4; color: #595c5f; }
    .badge-soft-info { background-color: #cff4fc; color: #055160; }
    .nav-pills .nav-link {
        color: #495057;
        font-weight: 600;
        padding: 0.6rem 1.25rem;
        border-radius: 8px;
    }
    .nav-pills .nav-link.active {
        background-color: #0d6efd;
        color: #fff;
    }
    .table th {
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
@endpush

@section('content')
<div class="card p-0 border-0 shadow-sm">
    <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <ul class="nav nav-pills" id="jabatanTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="jabatan-list-tab" data-bs-toggle="tab" data-bs-target="#jabatan-list" type="button" role="tab" aria-controls="jabatan-list" aria-selected="true">
                    <i class="fa-solid fa-briefcase me-1"></i> Daftar Jabatan
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="kelas-list-tab" data-bs-toggle="tab" data-bs-target="#kelas-list" type="button" role="tab" aria-controls="kelas-list" aria-selected="false">
                    <i class="fa-solid fa-layer-group me-1"></i> Standar Kelas Jabatan & Basic TPP
                </button>
            </li>
        </ul>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createJabatanModal">
            <i class="fa-solid fa-plus me-1"></i> Tambah Jabatan
        </button>
    </div>

    <div class="card-body p-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="tab-content" id="jabatanTabContent">
            <!-- TAB 1: DAFTAR JABATAN -->
            <div class="tab-pane fade show active" id="jabatan-list" role="tabpanel" aria-labelledby="jabatan-list-tab">
                <div class="alert alert-info py-2 px-3 small d-flex align-items-center gap-2 mb-3">
                    <i class="fa-solid fa-circle-info text-info fs-5"></i>
                    <div>
                        <strong>Pengaturan TPP Fleksibel:</strong> Besaran TPP PNS disesuaikan spesifik per jabatan (dapat diisi khusus melebihi/di bawah standar kelas). Untuk PPPK dan CPNS default regulasi adalah flat Rp 250.000 atau dapat diubah.
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle w-100 dataTable" id="tableJabatan">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Nama Jabatan</th>
                                <th>Jenis</th>
                                <th>Kelas</th>
                                <th>TPP</th>
                                <th class="text-center">Pegawai</th>
                                <th class="text-center" style="width: 12%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jabatans as $index => $j)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $j->nama_jabatan }}</div>
                                </td>
                                <td>
                                    @php
                                        $badgeClass = match($j->jenis_jabatan) {
                                            'struktural' => 'badge-soft-primary',
                                            'fungsional' => 'badge-soft-success',
                                            'pelaksana' => 'badge-soft-warning',
                                            default => 'badge-soft-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} px-2 py-1 text-capitalize">
                                        {{ $j->jenis_jabatan ?? '-' }}
                                    </span>
                                </td>
                                <td data-order="{{ $j->kelasJabatan?->kelas ?? 0 }}">
                                    @if($j->kelasJabatan)
                                        <span class="badge badge-soft-info px-2 py-1">
                                            Kelas {{ $j->kelasJabatan->kelas }}
                                        </span>
                                        <div class="text-muted" style="font-size: 0.75rem;">
                                            Basic: Rp {{ number_format($j->kelasJabatan->basic_tpp, 0, ',', '.') }}
                                        </div>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td data-order="{{ $j->tpp_pns ?: ($j->kelasJabatan?->basic_tpp ?? 0) }}">
                                    @if($j->tpp_pns !== null && $j->tpp_pns > 0)
                                        <div class="text-success fw-bold">Rp {{ number_format($j->tpp_pns, 0, ',', '.') }}</div>
                                        <span class="badge bg-light text-secondary border" style="font-size: 0.7rem;">Murni (Khusus)</span>
                                    @elseif($j->kelasJabatan)
                                        <div class="text-primary fw-semibold">Rp {{ number_format($j->kelasJabatan->basic_tpp, 0, ',', '.') }}</div>
                                        <span class="badge bg-light text-muted border" style="font-size: 0.7rem;">Murni (Standar Kelas)</span>
                                    @else
                                        <span class="text-muted small">Rp 0</span>
                                    @endif

                                    @if($j->tpp_penyetaraan !== null && $j->tpp_penyetaraan > 0)
                                        <div class="mt-1 pt-1 border-top" style="border-style: dashed !important;">
                                            <div class="text-danger fw-bold" style="font-size: 0.85rem;">Rp {{ number_format($j->tpp_penyetaraan, 0, ',', '.') }}</div>
                                            <span class="badge bg-warning bg-opacity-25 text-dark border border-warning" style="font-size: 0.68rem;"><i class="fa-solid fa-arrows-split-up-and-left me-1"></i>Penyetaraan</span>
                                        </div>
                                    @endif
                                </td>
                                
                                <td class="text-center" data-order="{{ $j->pegawai_count }}">
                                    @if($j->pegawai_count > 0)
                                        <span class="badge bg-primary rounded-pill px-2 py-1">{{ $j->pegawai_count }} Orang</span>
                                    @else
                                        <span class="badge bg-light text-muted border rounded-pill px-2">0</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-outline-warning edit-jabatan-btn"
                                            data-id="{{ $j->id }}"
                                            data-nama="{{ $j->nama_jabatan }}"
                                            data-jenis="{{ $j->jenis_jabatan }}"
                                            data-kelas="{{ $j->ref_kelas_jabatan_id }}"
                                            data-tpp_pns="{{ $j->tpp_pns }}"
                                            data-tpp_penyetaraan="{{ $j->tpp_penyetaraan }}"
                                            data-tpp_pppk="{{ $j->tpp_pppk ?? 250000 }}"
                                            data-tpp_cpns="{{ $j->tpp_cpns ?? 250000 }}"
                                            title="Edit Jabatan">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger delete-jabatan-btn"
                                            data-id="{{ $j->id }}"
                                            data-nama="{{ $j->nama_jabatan }}"
                                            data-count="{{ $j->pegawai_count }}"
                                            title="Hapus Jabatan">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 2: STANDAR KELAS JABATAN -->
            <div class="tab-pane fade" id="kelas-list" role="tabpanel" aria-labelledby="kelas-list-tab">
                <div class="alert alert-secondary py-2 px-3 small d-flex align-items-center gap-2 mb-3">
                    <i class="fa-solid fa-sliders text-secondary fs-5"></i>
                    <div>
                        <strong>Standar Acuan Basic TPP:</strong> Nilai TPP dasar untuk setiap kelas jabatan (Kelas 1 s/d 15). Jabatan PNS yang tidak ditentukan nilai khusus akan otomatis menggunakan besaran Basic TPP kelas ini.
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle w-100 dataTable" id="tableKelas">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 10%">Kelas</th>
                                <th>Keterangan / Nama Kelas</th>
                                <th>Standar Acuan Basic TPP</th>
                                <th class="text-center">Total Jabatan Terkait</th>
                                <th class="text-center" style="width: 12%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kelasJabatans as $k)
                            <tr>
                                <td>
                                    <span class="badge bg-dark px-3 py-2 fs-6">Kelas {{ $k->kelas }}</span>
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $k->nama_kelas ?? ('Kelas Jabatan ' . $k->kelas) }}</span>
                                </td>
                                <td>
                                    <span class="text-success fw-bold fs-6">Rp {{ number_format($k->basic_tpp, 0, ',', '.') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-soft-info px-2 py-1">{{ $k->jabatans_count }} Jabatan</span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-warning edit-kelas-btn"
                                        data-id="{{ $k->id }}"
                                        data-kelas="{{ $k->kelas }}"
                                        data-nama="{{ $k->nama_kelas }}"
                                        data-tpp="{{ $k->basic_tpp }}"
                                        title="Edit Basic TPP Kelas">
                                        <i class="fa-solid fa-pen me-1"></i> Edit TPP
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH JABATAN -->
<div class="modal fade" id="createJabatanModal" tabindex="-1" aria-labelledby="createJabatanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createJabatanModalLabel"><i class="fa-solid fa-plus-circle me-1"></i> Tambah Jabatan Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('jabatan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_jabatan" class="form-control" required placeholder="Contoh: Penata Perizinan Ahli Muda">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jenis Jabatan</label>
                            <select name="jenis_jabatan" class="form-select">
                                <option value="">-- Pilih Jenis --</option>
                                <option value="fungsional">Fungsional</option>
                                <option value="struktural">Struktural</option>
                                <option value="pelaksana">Pelaksana</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kelas Jabatan</label>
                            <select name="ref_kelas_jabatan_id" class="form-select">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($kelasJabatans as $kj)
                                    <option value="{{ $kj->id }}">Kelas {{ $kj->kelas }} (Rp {{ number_format($kj->basic_tpp, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card bg-light border-0 p-3 mb-2">
                        <h6 class="fw-bold mb-2 text-secondary"><i class="fa-solid fa-money-bill-wave me-1"></i> Penyesuaian Nilai TPP</h6>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-semibold">TPP PNS Murni (Rp)</label>
                                <input type="number" name="tpp_pns" class="form-control" placeholder="Standar/Kosongkan">
                                <span class="text-muted" style="font-size: 0.72rem;">*Kosongkan jika ikut basic kelas</span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-semibold text-danger">TPP Penyetaraan (Rp)</label>
                                <input type="number" name="tpp_penyetaraan" class="form-control" placeholder="Contoh: setara Kabid">
                                <span class="text-muted" style="font-size: 0.72rem;">*Khusus PNS eks-struktural</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-semibold">TPP PPPK (Rp)</label>
                                <input type="number" name="tpp_pppk" class="form-control" value="250000" min="0">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-semibold">TPP CPNS (Rp)</label>
                                <input type="number" name="tpp_cpns" class="form-control" value="250000" min="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-1"></i> Simpan Jabatan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT JABATAN -->
<div class="modal fade" id="editJabatanModal" tabindex="-1" aria-labelledby="editJabatanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title fw-bold" id="editJabatanModalLabel"><i class="fa-solid fa-pen-to-square me-1"></i> Edit Jabatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editJabatanForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_jabatan" id="edit_nama_jabatan" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jenis Jabatan</label>
                            <select name="jenis_jabatan" id="edit_jenis_jabatan" class="form-select">
                                <option value="">-- Pilih Jenis --</option>
                                <option value="fungsional">Fungsional</option>
                                <option value="struktural">Struktural</option>
                                <option value="pelaksana">Pelaksana</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kelas Jabatan</label>
                            <select name="ref_kelas_jabatan_id" id="edit_ref_kelas_jabatan_id" class="form-select">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($kelasJabatans as $kj)
                                    <option value="{{ $kj->id }}">Kelas {{ $kj->kelas }} (Rp {{ number_format($kj->basic_tpp, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card bg-light border-0 p-3 mb-2">
                        <h6 class="fw-bold mb-2 text-secondary"><i class="fa-solid fa-money-bill-wave me-1"></i> Penyesuaian Nilai TPP</h6>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-semibold">TPP PNS Murni (Rp)</label>
                                <input type="number" name="tpp_pns" id="edit_tpp_pns" class="form-control" placeholder="Standar/Kosongkan">
                                <span class="text-muted" style="font-size: 0.72rem;">*Kosongkan jika ikut basic kelas</span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-semibold text-danger">TPP Penyetaraan (Rp)</label>
                                <input type="number" name="tpp_penyetaraan" id="edit_tpp_penyetaraan" class="form-control" placeholder="Contoh: setara Kabid">
                                <span class="text-muted" style="font-size: 0.72rem;">*Khusus PNS eks-struktural</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-semibold">TPP PPPK (Rp)</label>
                                <input type="number" name="tpp_pppk" id="edit_tpp_pppk" class="form-control" min="0">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-semibold">TPP CPNS (Rp)</label>
                                <input type="number" name="tpp_cpns" id="edit_tpp_cpns" class="form-control" min="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-dark fw-bold"><i class="fa-solid fa-save me-1"></i> Update Jabatan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT BASIC TPP KELAS -->
<div class="modal fade" id="editKelasModal" tabindex="-1" aria-labelledby="editKelasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="editKelasModalLabel"><i class="fa-solid fa-sliders me-1"></i> Edit Standar Basic TPP Kelas</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editKelasForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="alert alert-info py-2">
                        Mengubah standar TPP untuk <strong id="labelKelasNama">Kelas Jabatan</strong>.
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keterangan / Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="edit_nama_kelas" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Standar Basic TPP (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="basic_tpp" id="edit_basic_tpp" class="form-control form-control-lg text-success fw-bold" required min="0">
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-1"></i> Simpan Nilai Acuan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- HIDDEN DELETE FORM -->
<form id="deleteJabatanForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Init DataTables
        const tableJabatan = $('#tableJabatan').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            },
            pageLength: 25,
            order: [], // Pertahankan urutan dari server (Kelas tertinggi ke terendah)
            columnDefs: [
                { orderable: false, targets: [0, 6] }
            ]
        });

        // Penomoran otomatis dinamis agar selalu rapi 1, 2, 3...
        tableJabatan.on('draw.dt', function () {
            let pageInfo = tableJabatan.page.info();
            tableJabatan.column(0, { search: 'applied', order: 'applied', page: 'current' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + pageInfo.start;
            });
        });

        $('#tableKelas').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            },
            pageLength: 25,
            order: [[0, 'asc']]
        });

        // Edit Jabatan Modal
        const editJabatanModal = new bootstrap.Modal(document.getElementById('editJabatanModal'));
        $('.edit-jabatan-btn').on('click', function() {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            const jenis = $(this).data('jenis');
            const kelas = $(this).data('kelas');
            const tppPns = $(this).data('tpp_pns');
            const tppPenyetaraan = $(this).data('tpp_penyetaraan');
            const tppPppk = $(this).data('tpp_pppk');
            const tppCpns = $(this).data('tpp_cpns');

            $('#edit_nama_jabatan').val(nama);
            $('#edit_jenis_jabatan').val(jenis);
            $('#edit_ref_kelas_jabatan_id').val(kelas);
            $('#edit_tpp_pns').val(tppPns !== '' && tppPns !== null ? tppPns : '');
            $('#edit_tpp_penyetaraan').val(tppPenyetaraan !== '' && tppPenyetaraan !== null ? tppPenyetaraan : '');
            $('#edit_tpp_pppk').val(tppPppk);
            $('#edit_tpp_cpns').val(tppCpns);

            $('#editJabatanForm').attr('action', '/jabatan/' + id);
            editJabatanModal.show();
        });

        // Delete Jabatan
        $('.delete-jabatan-btn').on('click', function() {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            const count = parseInt($(this).data('count') || 0);

            if (count > 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak Dapat Menghapus',
                    text: `Jabatan "${nama}" masih digunakan oleh ${count} pegawai. Silakan ubah jabatan pegawai terkait terlebih dahulu.`,
                    confirmButtonText: 'Mengerti'
                });
                return;
            }

            Swal.fire({
                title: 'Hapus Jabatan?',
                text: `Apakah Anda yakin ingin menghapus jabatan "${nama}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $('#deleteJabatanForm');
                    form.attr('action', '/jabatan/' + id);
                    form.submit();
                }
            });
        });

        // Edit Kelas Modal
        const editKelasModal = new bootstrap.Modal(document.getElementById('editKelasModal'));
        $('.edit-kelas-btn').on('click', function() {
            const id = $(this).data('id');
            const kelas = $(this).data('kelas');
            const nama = $(this).data('nama');
            const tpp = $(this).data('tpp');

            $('#labelKelasNama').text(`Kelas ${kelas} (${nama || 'Kelas Jabatan ' + kelas})`);
            $('#edit_nama_kelas').val(nama);
            $('#edit_basic_tpp').val(tpp);

            $('#editKelasForm').attr('action', '/jabatan/kelas/' + id);
            editKelasModal.show();
        });
    });
</script>
@endpush
