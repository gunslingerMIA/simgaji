@extends('layouts.app')

@section('title', 'Data Pegawai')
@section('page_title', 'Master Data Pegawai')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    .view-pegawai {
        cursor: pointer;
    }
    .view-pegawai:hover .fw-bold {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="card p-0 border-0 shadow-sm">
    <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Daftar Pegawai</h5>
        <div>
            <a href="{{ route('pegawai.template') }}" class="btn btn-success btn-sm me-1"><i class="fa-solid fa-file-excel me-1"></i> Template Excel</a>
            <button class="btn btn-info text-white btn-sm me-1" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fa-solid fa-file-import me-1"></i> Import</button>
            <a href="{{ route('pegawai.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i> Tambah Pegawai</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle w-100" id="pegawaiTable">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIP / Nama Pegawai</th>
                        <th>Status / Gol</th>
                        <th>Jabatan</th>
                        <th>Rekening</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pegawais as $pegawai)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="javascript:void(0)" class="text-decoration-none view-pegawai" data-id="{{ $pegawai->id }}">
                                <div class="fw-bold text-primary">{{ $pegawai->gelar_depan ? $pegawai->gelar_depan . ' ' : '' }}{{ $pegawai->nama_lengkap }}{{ $pegawai->gelar_belakang ? ', ' . $pegawai->gelar_belakang : '' }}</div>
                                <div class="small text-muted text-dark">{{ $pegawai->nip }}</div>
                            </a>
                        </td>
                        <td>
                            <div><span class="badge bg-secondary">{{ strtoupper(str_replace('_', ' ', $pegawai->status_kepegawaian)) }}</span></div>
                            <div class="small mt-1">Gol. {{ $pegawai->status_kepegawaian === 'pppk_paruh_waktu' ? '-' : $pegawai->golongan }}</div>
                        </td>
                        <td>{{ $pegawai->jabatan ? $pegawai->jabatan->nama_jabatan : '-' }}</td>
                        <td>
                            <div>{{ $pegawai->nomor_rekening }}</div>
                            <div class="small text-muted">{{ $pegawai->nama_pada_rekening }} ({{ $pegawai->nama_bank ?? 'Bank Jateng' }})</div>
                        </td>
                        <td>
                            @if($pegawai->is_active)
                                <span class="badge bg-success bg-opacity-10 text-success">Aktif</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger">Non-Aktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pegawai.show', $pegawai->id) }}" class="btn btn-sm btn-info text-white" title="Detail"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-sm btn-warning text-white" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Quick Preview -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <div class="modal-header border-bottom-0 pb-0">
        <h5 class="modal-title fw-bold" id="previewName">Loading...</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="text-center" id="previewLoader">
              <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
          </div>
          
          <div id="previewContent" style="display: none;">
              <!-- Data Utama & MKG -->
              <div class="row mb-4">
                  <div class="col-md-6">
                      <div class="mb-2"><small class="text-muted fw-bold d-block">NIP / NIK</small><span id="previewNipNik"></span></div>
                      <div class="mb-2"><small class="text-muted fw-bold d-block">Status / Golongan</small><span id="previewStatusGol"></span></div>
                      <div class="mb-2"><small class="text-muted fw-bold d-block">Jabatan</small><span id="previewJabatan"></span></div>
                  </div>
                  <div class="col-md-6">
                      <div class="p-3 bg-light rounded-3 border">
                          <h6 class="fw-bold text-primary mb-2"><i class="fa-solid fa-clock-rotate-left me-1"></i> Perhitungan MKG (Bulan Ini)</h6>
                          <div class="d-flex justify-content-between mb-1">
                              <span class="text-muted small">TMT Acuan (KGB/KP)</span>
                              <span class="fw-semibold small" id="previewTmtAcuan"></span>
                          </div>
                          <div class="d-flex justify-content-between mb-1">
                              <span class="text-muted small">MKG Master (Sesuai SK)</span>
                              <span class="fw-semibold small" id="previewMkgMaster"></span>
                          </div>
                          <hr class="my-2">
                          <div class="d-flex justify-content-between align-items-center">
                              <span class="fw-bold">MKG Saat Ini</span>
                              <span class="badge bg-primary fs-6" id="previewMkgCurrent"></span>
                          </div>
                          <div class="d-flex justify-content-between align-items-center mt-2" id="previewGajiPokokContainer" style="display: none;">
                              <span class="fw-bold">Gaji Pokok (Est)</span>
                              <span class="badge bg-success fs-6" id="previewGajiPokok"></span>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Data Keluarga -->
              <h6 class="fw-bold mb-3 border-bottom pb-2">Keluarga (Tunjangan)</h6>
              <div class="row">
                  <div class="col-md-12 mb-3">
                      <strong class="d-block mb-1 text-primary">Pasangan:</strong>
                      <ul class="list-group list-group-flush border rounded-3" id="previewPasanganList">
                          <!-- Injected via JS -->
                      </ul>
                  </div>
                  <div class="col-md-12">
                      <strong class="d-block mb-1 text-info">Anak:</strong>
                      <ul class="list-group list-group-flush border rounded-3" id="previewAnakList">
                          <!-- Injected via JS -->
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal-footer border-top-0 pt-0">
          <a href="#" id="previewDetailLink" class="btn btn-outline-primary btn-sm">Buka Halaman Detail</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header border-bottom-0 pb-0">
        <h5 class="modal-title fw-bold">Import Data Pegawai</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('pegawai.import') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
              <div class="alert alert-info py-2">
                  <small><i class="fa-solid fa-circle-info me-1"></i> Pastikan Anda sudah mengunduh dan menggunakan format template terbaru.</small>
              </div>
              <div class="mb-3">
                  <label class="form-label fw-semibold">File Excel (.xlsx, .xls, .csv)</label>
                  <input type="file" name="file_excel" class="form-control" accept=".xlsx,.xls,.csv" required>
              </div>
          </div>
          <div class="modal-footer border-top-0 pt-0">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-cloud-arrow-up me-1"></i> Mulai Import</button>
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
        $('#pegawaiTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
            },
            responsive: true
        });

        // SweetAlert Delete Confirmation
        $(document).on('submit', '.delete-form', function(e){
            e.preventDefault();
            let form = this;
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data pegawai beserta riwayat keluarganya akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });

        // Preview Modal AJAX
        const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
        
        $('.view-pegawai').on('click', function() {
            let pegawaiId = $(this).data('id');
            
            // Show Modal and Loader
            $('#previewContent').hide();
            $('#previewLoader').show();
            $('#previewName').text('Loading...');
            previewModal.show();

            // Set Detail Link
            $('#previewDetailLink').attr('href', '/pegawai/' + pegawaiId);

            // Fetch Data
            $.ajax({
                url: '/pegawai/' + pegawaiId + '/api-detail',
                method: 'GET',
                success: function(res) {
                    let p = res.pegawai;
                    let m = res.current_mkg;
                    
                    // Format Name
                    let fullName = (p.gelar_depan ? p.gelar_depan + ' ' : '') + p.nama_lengkap + (p.gelar_belakang ? ', ' + p.gelar_belakang : '');
                    $('#previewName').text(fullName);
                    
                    // Basic Data
                    $('#previewNipNik').text(p.nip + ' / ' + p.nik);
                    let statusLabel = p.status_kepegawaian.replace('_', ' ').toUpperCase();
                    let golLabel = p.status_kepegawaian === 'pppk_paruh_waktu' ? '-' : p.golongan;
                    $('#previewStatusGol').html('<span class="badge bg-secondary">' + statusLabel + '</span> Gol. ' + golLabel);
                    $('#previewJabatan').text(p.jabatan ? p.jabatan.nama_jabatan : '-');
                    
                    // MKG Data
                    $('#previewTmtAcuan').text(m.tmt_acuan);
                    if (p.status_kepegawaian === 'pppk_paruh_waktu') {
                        let gaji = p.gaji_kontrak ? new Intl.NumberFormat('id-ID').format(p.gaji_kontrak) : '0';
                        $('#previewMkgMaster').html('<span class="text-success">Rp ' + gaji + '</span> (Sesuai Kontrak)');
                        $('#previewMkgCurrent').text('-');
                        $('#previewGajiPokokContainer').hide();
                    } else {
                        $('#previewMkgMaster').text(p.mkg_tahun + ' Tahun ' + p.mkg_bulan + ' Bulan');
                        $('#previewMkgCurrent').text(m.tahun + ' Tahun ' + m.bulan + ' Bulan');
                        
                        let gajiPokok = res.gaji_pokok ? new Intl.NumberFormat('id-ID').format(res.gaji_pokok) : '0';
                        $('#previewGajiPokok').text('Rp ' + gajiPokok);
                        $('#previewGajiPokokContainer').show();
                    }

                    // Pasangan
                    let pasanganHtml = '';
                    if (p.pasangan.length > 0) {
                        p.pasangan.forEach(function(pas) {
                            let badge = pas.dapat_tunjangan ? '<span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 float-end">Dapat Tunjangan</span>' : '<span class="badge bg-secondary bg-opacity-10 text-secondary float-end">Tidak</span>';
                            pasanganHtml += '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                '<div><strong>' + pas.nama_pasangan + '</strong><br><small class="text-muted">' + pas.pekerjaan + '</small></div>' + badge + '</li>';
                        });
                    } else {
                        pasanganHtml = '<li class="list-group-item text-muted text-center py-3">Belum ada data pasangan</li>';
                    }
                    $('#previewPasanganList').html(pasanganHtml);

                    // Anak
                    let anakHtml = '';
                    if (p.anak.length > 0) {
                        p.anak.forEach(function(an) {
                            let badge = an.dapat_tunjangan ? '<span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 float-end">Dapat Tunjangan</span>' : '<span class="badge bg-secondary bg-opacity-10 text-secondary float-end">Tidak</span>';
                            anakHtml += '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                '<div><strong>' + an.nama_anak + '</strong> (Anak Ke-' + an.anak_ke + ')<br><small class="text-muted">Status: Anak ' + an.status_anak.charAt(0).toUpperCase() + an.status_anak.slice(1) + '</small></div>' + badge + '</li>';
                        });
                    } else {
                        anakHtml = '<li class="list-group-item text-muted text-center py-3">Belum ada data anak</li>';
                    }
                    $('#previewAnakList').html(anakHtml);

                    // Show content
                    $('#previewLoader').hide();
                    $('#previewContent').fadeIn();
                },
                error: function() {
                    $('#previewName').text('Terjadi Kesalahan');
                    $('#previewLoader').hide();
                }
            });
        });
    });
</script>
@endpush
