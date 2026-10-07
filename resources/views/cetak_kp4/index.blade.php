@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<style>
    .card-filter-kp4 {
        position: relative;
        z-index: 1050;
        overflow: visible !important;
    }
    .card-filter-kp4 .card-body {
        overflow: visible !important;
    }
    .choices {
        margin-bottom: 0;
    }
    .choices .choices__list--dropdown,
    .choices[data-type*="select-one"] .choices__list--dropdown,
    .choices__list[aria-expanded] {
        z-index: 99999 !important;
        box-shadow: 0 10px 25px rgba(0,0,0,0.18) !important;
        background-color: #ffffff !important;
        max-height: 320px !important;
    }
    .choices__list--dropdown .choices__item--selectable {
        padding-right: 15px !important;
    }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 text-gray-800">Cetak Form KP4</h4>
        <p class="text-muted mb-0">Halaman terpusat untuk mencetak KP4 seluruh pegawai.</p>
    </div>
</div>

<div class="card shadow-sm border-0 mb-4 card-filter-kp4">
    <div class="card-body">
        <form id="formCetakKp4" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="tanggal_kp4" class="form-label fw-semibold">Tanggal KP4</label>
                <input type="date" class="form-control" id="tanggal_kp4" name="tanggal_kp4" value="{{ date('Y-01-01') }}" required>
            </div>
            <div class="col-md-6">
                <label for="pegawai_id" class="form-label fw-semibold">Pilih Pegawai (Aktif - PNS / PPPK Penuh Waktu)</label>
                <select id="pegawai_id" name="pegawai_id" class="form-select" required>
                    <option value="">-- Pilih Pegawai --</option>
                    @foreach($pegawais as $pegawai)
                        <option value="{{ $pegawai->id }}">[{{ strtoupper($pegawai->status_kepegawaian) }}] {{ $pegawai->nip }} - {{ $pegawai->nama_lengkap_bergelar ?? $pegawai->nama_lengkap }}</option>
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

<div class="card shadow-sm border-0 d-none" id="previewContainer" style="position: relative; z-index: 1;">
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
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Choices.js with full search limit & keep choices accessible
        const choicesEl = document.getElementById('pegawai_id');
        const choices = new Choices(choicesEl, {
            searchEnabled: true,
            searchPlaceholderValue: 'Cari nama atau NIP...',
            itemSelectText: '',
            noResultsText: 'Pegawai tidak ditemukan',
            noChoicesText: 'Tidak ada pilihan',
            shouldSort: false,
            searchResultLimit: 500,
            renderChoiceLimit: -1,
            removeItemButton: false,
            allowHTML: false,
            position: 'bottom',
        });

        // Always clear search input when dropdown is shown so all options are listed
        choicesEl.addEventListener('showDropdown', function() {
            choices.clearInput();
        });

        const btnPreview = document.getElementById('btnPreview');
        const btnPrint = document.getElementById('btnPrint');
        const previewContainer = document.getElementById('previewContainer');
        const previewFrame = document.getElementById('previewFrame');

        function getSelectedPegawaiId() {
            return choices.getValue(true) || choicesEl.value;
        }

        function tampilkanPreview() {
            const pegawaiId = getSelectedPegawaiId();
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
            const pegawaiId = getSelectedPegawaiId();
            const tanggalKp4 = document.getElementById('tanggal_kp4').value;
            if (!pegawaiId || !tanggalKp4) return;
            window.open(`/pegawai/${pegawaiId}/kp4?tanggal_kp4=${tanggalKp4}`, '_blank');
        });

        // Auto-refresh preview if already open
        choicesEl.addEventListener('change', function() {
            if (!previewContainer.classList.contains('d-none')) {
                tampilkanPreview();
            }
        });

        document.getElementById('tanggal_kp4').addEventListener('change', function() {
            if (!previewContainer.classList.contains('d-none')) {
                tampilkanPreview();
            }
        });
    });
</script>
@endpush
