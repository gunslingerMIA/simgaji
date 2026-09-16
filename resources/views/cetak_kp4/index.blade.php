@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 text-gray-800">Cetak Form KP4</h4>
        <p class="text-muted mb-0">Halaman terpusat untuk mencetak KP4 seluruh pegawai.</p>
    </div>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <form id="formCetakKp4" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="tanggal_kp4" class="form-label fw-semibold">Tanggal KP4</label>
                <input type="date" class="form-control" id="tanggal_kp4" name="tanggal_kp4" value="{{ date('Y-01-01') }}" required>
            </div>
            <div class="col-md-6">
                <label for="pegawai_id" class="form-label fw-semibold">Pilih Pegawai (Aktif)</label>
                <select id="pegawai_id" name="pegawai_id" class="form-select" required>
                    <option value="">-- Pilih Pegawai --</option>
                    @foreach($pegawais as $pegawai)
                        <option value="{{ $pegawai->id }}">{{ $pegawai->nip }} - {{ $pegawai->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="button" id="btnPreview" class="btn btn-primary flex-grow-1">
                    <i class="fa-solid fa-eye me-1"></i> Preview
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0 d-none" id="previewContainer">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Preview Cetak</h6>
        <button type="button" id="btnPrint" class="btn btn-sm btn-success">
            <i class="fa-solid fa-print me-1"></i> Cetak Dokumen
        </button>
    </div>
    <div class="card-body">
        <div class="ratio ratio-1x1 border rounded" style="height: 600px;">
            <iframe id="previewFrame" src="" allowfullscreen></iframe>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Choices.js
        const choicesEl = document.getElementById('pegawai_id');
        const choices = new Choices(choicesEl, {
            searchEnabled: true,
            searchPlaceholderValue: 'Cari nama atau NIP...',
            itemSelectText: '',
            noResultsText: 'Pegawai tidak ditemukan',
            noChoicesText: 'Tidak ada pilihan',
        });

        const btnPreview = document.getElementById('btnPreview');
        const btnPrint = document.getElementById('btnPrint');
        const previewContainer = document.getElementById('previewContainer');
        const previewFrame = document.getElementById('previewFrame');

        function tampilkanPreview() {
            const pegawaiId = choicesEl.value;
            const tanggalKp4 = document.getElementById('tanggal_kp4').value;

            if (!pegawaiId) {
                Swal.fire('Perhatian', 'Silakan pilih pegawai terlebih dahulu!', 'warning');
                return;
            }
            if (!tanggalKp4) {
                Swal.fire('Perhatian', 'Silakan tentukan tanggal KP4!', 'warning');
                return;
            }

            previewFrame.src = `/pegawai/${pegawaiId}/kp4?tanggal_kp4=${tanggalKp4}&preview=true`;
            previewContainer.classList.remove('d-none');
        }

        btnPreview.addEventListener('click', tampilkanPreview);

        btnPrint.addEventListener('click', function() {
            const pegawaiId = choicesEl.value;
            const tanggalKp4 = document.getElementById('tanggal_kp4').value;
            if (!pegawaiId || !tanggalKp4) return;
            window.open(`/pegawai/${pegawaiId}/kp4?tanggal_kp4=${tanggalKp4}`, '_blank');
        });

        // Auto-refresh preview if already open
        choicesEl.addEventListener('change', function() {
            if (!previewContainer.classList.contains('d-none')) tampilkanPreview();
        });

        document.getElementById('tanggal_kp4').addEventListener('change', function() {
            if (!previewContainer.classList.contains('d-none')) tampilkanPreview();
        });
    });
</script>
@endpush
