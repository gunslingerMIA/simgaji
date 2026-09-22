@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 text-primary"><i class="fa-solid fa-money-check-dollar me-2"></i>Data Gaji Induk PPPK Penuh Waktu</h4>
                        <p class="text-muted small mb-0">Menampilkan data gaji induk untuk bulan {{ str_pad($bulan, 2, '0', STR_PAD_LEFT) }} tahun {{ $tahun }}.</p>
                    </div>
                    <div>
                        <a href="{{ route('gaji-induk-pppk.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Generate Gaji
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('gaji-induk-pppk.index') }}" method="GET" class="mb-4">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-2">
                                <label for="bulan" class="form-label text-muted small fw-bold">Bulan</label>
                                <select name="bulan" id="bulan" class="form-select">
                                    @for($i = 1; $i <= 12; $i++)
                                        @php $m = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                                        <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>{{ $m }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="tahun" class="form-label text-muted small fw-bold">Tahun</label>
                                <select name="tahun" id="tahun" class="form-select">
                                    @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-secondary w-100"><i class="fa-solid fa-filter me-1"></i> Filter</button>
                            </div>
                            <div class="col-md-6 text-end">
                                @if(count($gajiPppk) > 0)
                                    @php $isLocked = $gajiPppk->first()->is_locked; @endphp
                                    @if($isLocked)
                                        <button type="button" class="btn btn-outline-success fw-bold btn-unlock" title="Buka Kunci untuk Generate Ulang atau Edit">
                                            <i class="fa-solid fa-unlock me-1"></i> Buka Kunci
                                        </button>
                                        <span class="badge bg-success px-3 py-2 fs-6 ms-2"><i class="fa-solid fa-lock me-1"></i> Data Terkunci</span>
                                    @else
                                        <button type="button" class="btn btn-warning fw-bold text-dark btn-lock">
                                            <i class="fa-solid fa-lock me-1"></i> Kunci Data
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </form>

                    <!-- Hidden Forms for Lock/Unlock actions -->
                    @if(count($gajiPppk) > 0)
                        @if($isLocked)
                            <form action="{{ route('gaji-induk-pppk.unlock') }}" method="POST" id="form-unlock" class="d-none">
                                @csrf
                                <input type="hidden" name="bulan" value="{{ $bulan }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                            </form>
                        @else
                            <form action="{{ route('gaji-induk-pppk.lock') }}" method="POST" id="form-lock" class="d-none">
                                @csrf
                                <input type="hidden" name="bulan" value="{{ $bulan }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                            </form>
                        @endif
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle" style="font-size: 0.85em; white-space: nowrap;">
                            <thead class="table-light text-center align-middle">
                                <tr>
                                    <th rowspan="2" width="1%">No</th>
                                    <th rowspan="2">Pegawai</th>
                                    <th rowspan="2">Gol</th>
                                    <th colspan="13">Pendapatan</th>
                                    <th colspan="6">Potongan</th>
                                    <th rowspan="2" class="bg-success bg-opacity-10">Bersih</th>
                                    <th rowspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    <th>Gapok</th>
                                    <th>T.Istri</th>
                                    <th>T.Anak</th>
                                    <th>T.Struktural</th>
                                    <th>T.Fungsional</th>
                                    <th>T.Umum</th>
                                    <th>T.Beras</th>
                                    <th>T.BPJS</th>
                                    <th>T.JKK</th>
                                    <th>T.JKM</th>
                                    <th>Pembulatan</th>
                                    <th class="bg-primary bg-opacity-10">Total Kotor</th>
                                    
                                    <th>IWP 1%</th>
                                    <th>IWP 3.25%</th>
                                    <th>BPJS</th>
                                    <th>JKK</th>
                                    <th>JKM</th>
                                    <th>PPh</th>
                                    <th class="bg-danger bg-opacity-10">Total Pot.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gajiPppk as $index => $gaji)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $gaji->nama }}</div>
                                            <div class="text-muted" style="font-size: 0.85em;">{{ $gaji->nip }}</div>
                                        </td>
                                        <td class="text-center">{{ $gaji->golongan }}</td>
                                        
                                        <!-- Pendapatan -->
                                        <td class="text-end">{{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_suami_istri, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_anak, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_jabatan, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_fungsional, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_umum, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_beras, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_bpjs, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_jkk, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_jkm, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_pembulatan, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold text-primary bg-primary bg-opacity-10">{{ number_format($gaji->kotor_resmi, 0, ',', '.') }}</td>
                                        
                                        <!-- Potongan -->
                                        <td class="text-end">{{ number_format($gaji->potongan_iwp_1, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->potongan_iwp_3_25, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->potongan_bpjs, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->potongan_jkk, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->potongan_jkm, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->potongan_pph, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold text-danger bg-danger bg-opacity-10">{{ number_format($gaji->jumlah_potongan, 0, ',', '.') }}</td>
                                        
                                        <!-- Bersih -->
                                        <td class="text-end fw-bold text-success bg-success bg-opacity-10 fs-6">{{ number_format($gaji->bersih_resmi, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            @if(!$isLocked)
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-edit-tunjangan"
                                                data-id="{{ $gaji->id }}"
                                                data-nama="{{ $gaji->nama }}"
                                                data-struktural="{{ $gaji->tunjangan_jabatan }}"
                                                data-fungsional="{{ $gaji->tunjangan_fungsional }}"
                                                data-umum="{{ $gaji->tunjangan_umum }}"
                                                data-pph="{{ $gaji->potongan_pph }}"
                                                title="Edit Manual Tunjangan">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="24" class="text-center py-4 text-muted">Belum ada data gaji untuk periode ini. Silakan generate gaji terlebih dahulu.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if(count($gajiPppk) > 0)
                            <tfoot class="table-light text-end fw-bold">
                                <tr>
                                    <td colspan="3" class="text-center">TOTAL</td>
                                    <td>{{ number_format($gajiPppk->sum('gaji_pokok'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiPppk->sum('tunjangan_suami_istri'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiPppk->sum('tunjangan_anak'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiPppk->sum('tunjangan_jabatan'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiPppk->sum('tunjangan_fungsional'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiPppk->sum('tunjangan_umum'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiPppk->sum('tunjangan_beras'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiPppk->sum('tunjangan_bpjs'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiPppk->sum('tunjangan_jkk'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiPppk->sum('tunjangan_jkm'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiPppk->sum('tunjangan_pembulatan'), 0, ',', '.') }}</td>
                                    <td class="bg-primary bg-opacity-10 text-primary">{{ number_format($gajiPppk->sum('kotor_resmi'), 0, ',', '.') }}</td>
                                    
                                    <td>{{ number_format($gajiPppk->sum('potongan_iwp_1'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiPppk->sum('potongan_iwp_3_25'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiPppk->sum('potongan_bpjs'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiPppk->sum('potongan_jkk'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiPppk->sum('potongan_jkm'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiPppk->sum('potongan_pph'), 0, ',', '.') }}</td>
                                    <td class="bg-danger bg-opacity-10 text-danger">{{ number_format($gajiPppk->sum('jumlah_potongan'), 0, ',', '.') }}</td>
                                    
                                    <td class="bg-success bg-opacity-10 text-success fs-6">{{ number_format($gajiPppk->sum('bersih_resmi'), 0, ',', '.') }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Manual Tunjangan -->
<div class="modal fade" id="editTunjanganModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Manual Tunjangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editTunjanganForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="alert alert-info py-2" style="font-size: 0.9em;">
                        <i class="fa-solid fa-info-circle me-1"></i> Penyesuaian ini hanya berlaku untuk bulan dan tahun yang terpilih (snapshot). Komponen tunjangan lain, potongan, dan gaji bersih akan dihitung ulang otomatis saat Anda menyimpan.
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Pegawai</label>
                        <input type="text" id="edit_nama_pegawai" class="form-control bg-light" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-primary">Tunjangan Jabatan / Struktural (Rp)</label>
                        <input type="number" name="tunjangan_struktural" id="edit_tunj_struktural" class="form-control" required min="0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-success">Tunjangan Fungsional (Rp)</label>
                        <input type="number" name="tunjangan_fungsional" id="edit_tunj_fungsional" class="form-control" required min="0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Tunjangan Umum (Rp)</label>
                        <input type="number" name="tunjangan_umum" id="edit_tunj_umum" class="form-control" required min="0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-danger">Potongan PPh (Rp)</label>
                        <input type="number" name="potongan_pph" id="edit_tunj_pph" class="form-control" required min="0">
                        <small class="text-muted">Edit manual jika terjadi selisih pembulatan dengan SIMGAJI BPKAD/TASPEN.</small>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-1"></i> Simpan Penyesuaian</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-edit-tunjangan');
        const modal = new bootstrap.Modal(document.getElementById('editTunjanganModal'));
        const form = document.getElementById('editTunjanganForm');
        
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const struktural = this.getAttribute('data-struktural');
                const fungsional = this.getAttribute('data-fungsional');
                const umum = this.getAttribute('data-umum');
                const pph = this.getAttribute('data-pph');

                document.getElementById('edit_nama_pegawai').value = nama;
                document.getElementById('edit_tunj_struktural').value = struktural;
                document.getElementById('edit_tunj_fungsional').value = fungsional;
                document.getElementById('edit_tunj_umum').value = umum;
                document.getElementById('edit_tunj_pph').value = pph;

                form.setAttribute('action', `/gaji-induk-pppk/${id}`);
                modal.show();
            });
        });

        // SweetAlert for Lock Data
        const btnLock = document.querySelector('.btn-lock');
        if (btnLock) {
            btnLock.addEventListener('click', function() {
                Swal.fire({
                    title: 'Kunci Data?',
                    text: "Apakah Anda yakin ingin mengunci data bulan ini? Data yang terkunci tidak bisa di-_generate_ ulang atau diedit manual.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ffc107',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fa-solid fa-lock me-1"></i> Ya, Kunci Data',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-lock').submit();
                    }
                });
            });
        }

        // SweetAlert for Unlock Data
        const btnUnlock = document.querySelector('.btn-unlock');
        if (btnUnlock) {
            btnUnlock.addEventListener('click', function() {
                Swal.fire({
                    title: 'Buka Kunci Data?',
                    text: "Membuka kunci data akan mengizinkan Anda untuk _generate_ ulang gaji bulan ini atau mengedit manual baris data tertentu.",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fa-solid fa-unlock me-1"></i> Ya, Buka Kunci',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-unlock').submit();
                    }
                });
            });
        }
    });
</script>
@endpush
@endsection
