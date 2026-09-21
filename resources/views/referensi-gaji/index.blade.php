@extends('layouts.app')

@section('title', 'Referensi Gaji')
@section('page_title', 'Master Data Gaji Pokok')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
<div class="card p-0 border-0 shadow-sm">
    <div class="card-header bg-white border-bottom p-3">
        <ul class="nav nav-pills" id="gajiTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-semibold" id="pns-tab" data-bs-toggle="tab" data-bs-target="#pns" type="button" role="tab" aria-controls="pns" aria-selected="true">
                    Gaji Pokok PNS (PP 5/2024)
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold" id="pppk-tab" data-bs-toggle="tab" data-bs-target="#pppk" type="button" role="tab" aria-controls="pppk" aria-selected="false">
                    Gaji Pokok PPPK (Perpres 11/2024)
                </button>
            </li>
        </ul>
    </div>
    
    <div class="card-body">
        <div class="tab-content" id="gajiTabContent">
            
            <!-- Tab PNS -->
            <div class="tab-pane fade show active" id="pns" role="tabpanel" aria-labelledby="pns-tab">
                <div class="d-flex justify-content-between align-items-center mb-3 mt-2">
                    <h6 class="mb-0 fw-bold">Data Gaji Pokok PNS</h6>
                    <div>
                        <a href="{{ route('referensi-gaji.template.pns') }}" class="btn btn-sm btn-outline-success">
                            <i class="fa-solid fa-file-excel"></i> Download Template
                        </a>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#importPnsModal">
                            <i class="fa-solid fa-upload"></i> Import Excel
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle w-100 dataTable" id="tablePns">
                        <thead class="table-light">
                            <tr>
                                <th>Golongan</th>
                                <th>Masa Kerja (MKG)</th>
                                <th>Nominal Gaji Pokok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gajiPns as $pns)
                            <tr>
                                <td class="fw-bold">{{ $pns->golongan }}</td>
                                <td>{{ $pns->mkg }} Tahun</td>
                                <td class="text-success fw-semibold">Rp {{ number_format($pns->nominal, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning text-white edit-btn" 
                                            data-id="{{ $pns->id }}" 
                                            data-jenis="pns"
                                            data-golongan="{{ $pns->golongan }}"
                                            data-mkg="{{ $pns->mkg }}"
                                            data-nominal="{{ $pns->nominal }}">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tab PPPK -->
            <div class="tab-pane fade" id="pppk" role="tabpanel" aria-labelledby="pppk-tab">
                <div class="d-flex justify-content-between align-items-center mb-3 mt-2">
                    <h6 class="mb-0 fw-bold">Data Gaji Pokok PPPK</h6>
                    <div>
                        <a href="{{ route('referensi-gaji.template.pppk') }}" class="btn btn-sm btn-outline-success">
                            <i class="fa-solid fa-file-excel"></i> Download Template
                        </a>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#importPppkModal">
                            <i class="fa-solid fa-upload"></i> Import Excel
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle w-100 dataTable" id="tablePppk">
                        <thead class="table-light">
                            <tr>
                                <th>Golongan</th>
                                <th>Masa Kerja (MKG)</th>
                                <th>Nominal Gaji Pokok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gajiPppk as $pppk)
                            <tr>
                                <td class="fw-bold">{{ $pppk->golongan }}</td>
                                <td>{{ $pppk->mkg }} Tahun</td>
                                <td class="text-success fw-semibold">Rp {{ number_format($pppk->nominal, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning text-white edit-btn" 
                                            data-id="{{ $pppk->id }}" 
                                            data-jenis="pppk"
                                            data-golongan="{{ $pppk->golongan }}"
                                            data-mkg="{{ $pppk->mkg }}"
                                            data-nominal="{{ $pppk->nominal }}">
                                        <i class="fa-solid fa-pen"></i> Edit
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

<!-- Modal Import PNS -->
<div class="modal fade" id="importPnsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header border-bottom-0 pb-0">
        <h5 class="modal-title fw-bold">Import Gaji Pokok PNS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('referensi-gaji.import.pns') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
              <div class="mb-3">
                  <label class="form-label fw-semibold">File Excel (.xlsx, .xls, .csv)</label>
                  <input type="file" name="file" class="form-control" accept=".xlsx, .xls, .csv" required>
              </div>
          </div>
          <div class="modal-footer border-top-0 pt-0">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-upload me-1"></i> Import Data</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Import PPPK -->
<div class="modal fade" id="importPppkModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header border-bottom-0 pb-0">
        <h5 class="modal-title fw-bold">Import Gaji Pokok PPPK</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('referensi-gaji.import.pppk') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
              <div class="mb-3">
                  <label class="form-label fw-semibold">File Excel (.xlsx, .xls, .csv)</label>
                  <input type="file" name="file" class="form-control" accept=".xlsx, .xls, .csv" required>
              </div>
          </div>
          <div class="modal-footer border-top-0 pt-0">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-upload me-1"></i> Import Data</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Nominal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header border-bottom-0 pb-0">
        <h5 class="modal-title fw-bold">Edit Nominal Gaji</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">
              <div class="alert alert-info py-2">
                  Mengubah nominal untuk <strong>Golongan <span id="labelGolongan"></span></strong> masa kerja <strong><span id="labelMkg"></span> Tahun</strong>.
              </div>
              <div class="mb-3">
                  <label class="form-label fw-semibold">Nominal Gaji Pokok (Rp)</label>
                  <input type="number" name="nominal" id="inputNominal" class="form-control form-control-lg text-success fw-bold" required min="0">
              </div>
          </div>
          <div class="modal-footer border-top-0 pt-0">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning text-white"><i class="fa-solid fa-save me-1"></i> Simpan Perubahan</button>
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
        $('.dataTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
            },
            responsive: true,
            pageLength: 25
        });

        // Edit Button Handler
        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
        
        $('.edit-btn').on('click', function() {
            let id = $(this).data('id');
            let jenis = $(this).data('jenis'); // pns / pppk
            let golongan = $(this).data('golongan');
            let mkg = $(this).data('mkg');
            let nominal = $(this).data('nominal');

            $('#labelGolongan').text(golongan);
            $('#labelMkg').text(mkg);
            $('#inputNominal').val(nominal);

            // Set Form Action Route
            let actionUrl = '/referensi-gaji/' + jenis + '/' + id;
            $('#editForm').attr('action', actionUrl);

            editModal.show();
        });
    });
</script>
@endpush
