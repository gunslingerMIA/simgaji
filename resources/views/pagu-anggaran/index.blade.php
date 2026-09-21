@extends('layouts.app')

@section('title', 'Pagu Anggaran')
@section('page_title', 'Master Pagu Anggaran')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
<div class="card p-0 border-0 shadow-sm">
    <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Pagu Anggaran Tahun {{ $tahun }}</h5>
        
        <div class="d-flex gap-2">
            <!-- Filter Tahun -->
            <form action="{{ route('pagu-anggaran.index') }}" method="GET" class="d-flex align-items-center me-3">
                <label for="tahun" class="me-2 fw-semibold">Tahun:</label>
                <select name="tahun" id="tahun" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    @php $currentYear = date('Y'); @endphp
                    @for($y = $currentYear - 2; $y <= $currentYear + 2; $y++)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </form>
            
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fa-solid fa-plus"></i> Tambah Data
            </button>
        </div>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle w-100 dataTable" id="tablePagu">
                <thead class="table-light">
                    <tr>
                        <th>Kode Rekening</th>
                        <th>Uraian Rekening Belanja</th>
                        <th>Penetapan</th>
                        <th>Pergeseran</th>
                        <th>Perubahan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paguAnggaran as $pagu)
                    <tr>
                        <td class="fw-bold">{{ $pagu->kode_rekening }}</td>
                        <td>{{ $pagu->uraian }}</td>
                        <td class="text-end">Rp {{ number_format($pagu->pagu_penetapan, 0, ',', '.') }}</td>
                        <td class="text-end">Rp {{ number_format($pagu->pagu_pergeseran, 0, ',', '.') }}</td>
                        <td class="text-end text-success fw-semibold">Rp {{ number_format($pagu->pagu_perubahan, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning text-white edit-btn" 
                                    data-id="{{ $pagu->id }}" 
                                    data-kode="{{ $pagu->kode_rekening }}"
                                    data-uraian="{{ $pagu->uraian }}"
                                    data-penetapan="{{ $pagu->pagu_penetapan }}"
                                    data-pergeseran="{{ $pagu->pagu_pergeseran }}"
                                    data-perubahan="{{ $pagu->pagu_perubahan }}"
                                    data-tahun="{{ $pagu->tahun }}">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <form action="{{ route('pagu-anggaran.destroy', $pagu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <div class="modal-header border-bottom-0 pb-0">
        <h5 class="modal-title fw-bold">Tambah Pagu Anggaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('pagu-anggaran.store') }}" method="POST">
          @csrf
          <div class="modal-body">
              <input type="hidden" name="tahun" value="{{ $tahun }}">
              <div class="row mb-3">
                  <div class="col-md-4">
                      <label class="form-label fw-semibold">Kode Rekening</label>
                      <input type="text" name="kode_rekening" class="form-control" required placeholder="Contoh: 5.1.01.01.01">
                  </div>
                  <div class="col-md-8">
                      <label class="form-label fw-semibold">Uraian Rekening Belanja</label>
                      <input type="text" name="uraian" class="form-control" required placeholder="Contoh: Belanja Gaji Pokok PNS">
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-md-4">
                      <label class="form-label fw-semibold">Pagu Penetapan (Rp)</label>
                      <input type="number" name="pagu_penetapan" class="form-control text-end" required min="0" value="0">
                  </div>
                  <div class="col-md-4">
                      <label class="form-label fw-semibold">Pergeseran Sebelum Perubahan (Rp)</label>
                      <input type="number" name="pagu_pergeseran" class="form-control text-end" required min="0" value="0">
                  </div>
                  <div class="col-md-4">
                      <label class="form-label fw-semibold">Pagu Perubahan (Rp)</label>
                      <input type="number" name="pagu_perubahan" class="form-control text-end fw-bold text-success" required min="0" value="0">
                  </div>
              </div>
          </div>
          <div class="modal-footer border-top-0 pt-0">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-1"></i> Simpan</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <div class="modal-header border-bottom-0 pb-0">
        <h5 class="modal-title fw-bold">Edit Pagu Anggaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">
              <input type="hidden" name="tahun" id="editTahun">
              <div class="row mb-3">
                  <div class="col-md-4">
                      <label class="form-label fw-semibold">Kode Rekening</label>
                      <input type="text" name="kode_rekening" id="editKode" class="form-control" required>
                  </div>
                  <div class="col-md-8">
                      <label class="form-label fw-semibold">Uraian Rekening Belanja</label>
                      <input type="text" name="uraian" id="editUraian" class="form-control" required>
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-md-4">
                      <label class="form-label fw-semibold">Pagu Penetapan (Rp)</label>
                      <input type="number" name="pagu_penetapan" id="editPenetapan" class="form-control text-end" required min="0">
                  </div>
                  <div class="col-md-4">
                      <label class="form-label fw-semibold">Pergeseran Sebelum Perubahan (Rp)</label>
                      <input type="number" name="pagu_pergeseran" id="editPergeseran" class="form-control text-end" required min="0">
                  </div>
                  <div class="col-md-4">
                      <label class="form-label fw-semibold">Pagu Perubahan (Rp)</label>
                      <input type="number" name="pagu_perubahan" id="editPerubahan" class="form-control text-end fw-bold text-success" required min="0">
                  </div>
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
            let kode = $(this).data('kode');
            let uraian = $(this).data('uraian');
            let penetapan = $(this).data('penetapan');
            let pergeseran = $(this).data('pergeseran');
            let perubahan = $(this).data('perubahan');
            let tahun = $(this).data('tahun');

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
    });
</script>
@endpush
