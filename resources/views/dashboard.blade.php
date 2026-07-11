@extends('layouts.app')

@section('title', 'Dashboard Hasil Psikotes DISC | EQUITYWORLD')
@section('header', 'Hasil Psikotes DISC')

@section('content')
<!-- Baris Statistik -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="stat-card" style="border-left-color: #6c757d;">
            <div class="info">
                <h3>{{ $totalTests }}</h3>
                <p>Total Peserta Ujian</p>
            </div>
            <div class="icon" style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                <i class="fas fa-user-friends"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-6 mb-3">
        <div class="stat-card" style="border-left-color: #dc3545;">
            <div class="info">
                <h3>{{ $dominants['D'] }}</h3>
                <p>Dominance (D)</p>
            </div>
            <div class="icon" style="background: rgba(220, 53, 69, 0.1); color: #dc3545;">
                <span class="fw-bold">D</span>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-6 mb-3">
        <div class="stat-card" style="border-left-color: #ffc107;">
            <div class="info">
                <h3>{{ $dominants['I'] }}</h3>
                <p>Influence (I)</p>
            </div>
            <div class="icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                <span class="fw-bold">I</span>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-6 mb-3">
        <div class="stat-card" style="border-left-color: #198754;">
            <div class="info">
                <h3>{{ $dominants['S'] }}</h3>
                <p>Steadiness (S)</p>
            </div>
            <div class="icon" style="background: rgba(25, 135, 84, 0.1); color: #198754;">
                <span class="fw-bold">S</span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="stat-card" style="border-left-color: #0dcaf0;">
            <div class="info">
                <h3>{{ $dominants['C'] }}</h3>
                <p>Compliance (C)</p>
            </div>
            <div class="icon" style="background: rgba(13, 202, 240, 0.1); color: #0dcaf0;">
                <span class="fw-bold">C</span>
            </div>
        </div>
    </div>
</div>

<!-- Baris Grafik & Pencarian -->
<div class="row mb-4">
    <!-- Chart.js doughnut chart -->
    <div class="col-lg-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title m-0 fw-bold">Distribusi Kepribadian</h5>
            </div>
            <div class="card-body d-flex justify-content-center align-items-center">
                @if($totalTests > 0)
                    <div style="width: 80%; max-height: 250px;">
                        <canvas id="discDoughnutChart"></canvas>
                    </div>
                @else
                    <p class="text-muted text-center py-4">Belum ada data untuk grafis.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Pencarian & Filter -->
    <div class="col-lg-8 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title m-0 fw-bold">Pencarian & Aksi</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard') }}" method="GET" class="mb-4">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-body-secondary border-end-0 text-muted"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari nama peserta, universitas, no identitas..." value="{{ $search }}">
                        <button type="submit" class="btn btn-warning text-white fw-bold px-4" style="background-color: #fd7e14; border-color: #fd7e14;">Cari</button>
                        @if(!empty($search))
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary d-flex align-items-center">Reset</a>
                        @endif
                    </div>
                </form>

                <div class="p-3 bg-body-secondary rounded shadow-sm border">
                    <h6 class="fw-bold text-body-emphasis mb-2"><i class="fas fa-info-circle me-1 text-warning"></i> Informasi Tes Psikotes</h6>
                    <p class="small text-body-secondary mb-0">
                        Sistem ini menggunakan metode tes DISC (Dominance, Influence, Steadiness, Compliance) yang terdiri dari 24 pertanyaan. 
                        Tiap peserta mengisi biodata magang lengkap sebelum mengerjakan ujian. Hasil dikalkulasikan secara otomatis menjadi 3 grafik utama: MOST (Topeng), LEAST (Tekanan), dan CHANGE (Diri Sendiri).
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Baris Tabel Data -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header border-0 py-3">
                <h5 class="card-title m-0 fw-bold">Data Peserta & Hasil Ujian</h5>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary">
                        <tr>
                            <th class="ps-4">Nama Lengkap</th>
                            <th>No. Identitas / Universitas</th>
                            <th class="text-center">Profil Dominan</th>
                            <th class="text-center">Skor Change (D/I/S/C)</th>
                            <th>Tanggal Tes</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($results as $res)
                            @php
                                $biodata = $res->biodata;
                                $scores = [
                                    'D' => $res->score_d_change,
                                    'I' => $res->score_i_change,
                                    'S' => $res->score_s_change,
                                    'C' => $res->score_c_change,
                                ];
                                arsort($scores);
                                $dominant = key($scores);
                                
                                $badgeColor = 'bg-secondary';
                                if($dominant == 'D') $badgeColor = 'bg-danger';
                                elseif($dominant == 'I') $badgeColor = 'bg-warning text-dark';
                                elseif($dominant == 'S') $badgeColor = 'bg-success';
                                elseif($dominant == 'C') $badgeColor = 'bg-info text-dark';
                            @endphp
                            <tr id="row-{{ $res->id }}">
                                <td class="ps-4">
                                    <div class="fw-bold text-body">{{ $biodata->nama_lengkap ?? 'Tanpa Nama' }}</div>
                                    <small class="text-muted">{{ $biodata->no_telepon ?? '-' }}</small>
                                </td>
                                <td>
                                    <div>{{ $biodata->no_identitas ?? '-' }}</div>
                                    <small class="text-muted">{{ $biodata->universitas ?? '-' }} ({{ $biodata->fakultas ?? '-' }})</small>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $badgeColor }} px-3 py-2 fs-6 fw-bold rounded-pill shadow-sm">{{ $dominant }}</span>
                                </td>
                                <td class="text-center fw-medium">
                                    <span class="text-danger fw-bold">{{ $res->score_d_change }}</span> / 
                                    <span class="text-warning-emphasis fw-bold">{{ $res->score_i_change }}</span> / 
                                    <span class="text-success fw-bold">{{ $res->score_s_change }}</span> / 
                                    <span class="text-info fw-bold">{{ $res->score_c_change }}</span>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($res->created_at)->translatedFormat('d F Y H:i') }}
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-outline-primary" onclick="showDetailsModal({{ json_encode($biodata) }}, {{ json_encode($res) }})" title="Detail Biodata">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                        <a href="{{ route('psikotes.pdf', $res->id) }}" class="btn btn-outline-danger" target="_blank" title="Cetak PDF">
                                            <i class="fas fa-file-pdf"></i> PDF
                                        </a>
                                        <button type="button" class="btn btn-outline-secondary text-danger" onclick="deleteResult({{ $res->id }})" title="Hapus Data">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    <i class="fas fa-folder-open fa-3x mb-3 text-muted opacity-50"></i><br>
                                    Belum ada data peserta yang mengikuti tes psikotes.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($results->hasPages())
                <div class="card-footer border-0 py-3">
                    {{ $results->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Detail Biodata & Hasil -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title fw-bold" id="detailsModalLabel"><i class="fas fa-user-tag me-2 text-warning"></i> Detail Lengkap Peserta</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Nav Tabs -->
                <ul class="nav nav-tabs mb-3" id="detailsTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold" id="biodata-tab" data-bs-toggle="tab" data-bs-target="#biodata-tab-pane" type="button" role="tab" aria-controls="biodata-tab-pane" aria-selected="true">Biodata Diri</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold" id="parent-tab" data-bs-toggle="tab" data-bs-target="#parent-tab-pane" type="button" role="tab" aria-controls="parent-tab-pane" aria-selected="false">Orang Tua / Wali</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold" id="intern-tab" data-bs-toggle="tab" data-bs-target="#intern-tab-pane" type="button" role="tab" aria-controls="intern-tab-pane" aria-selected="false">Detail Magang</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold" id="scores-tab" data-bs-toggle="tab" data-bs-target="#scores-tab-pane" type="button" role="tab" aria-controls="scores-tab-pane" aria-selected="false">Skor Ujian DISC</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold" id="personality-tab" data-bs-toggle="tab" data-bs-target="#personality-tab-pane" type="button" role="tab" aria-controls="personality-tab-pane" aria-selected="false"><i class="fas fa-brain me-1 text-warning"></i> {{ __('messages.test_decision') }}</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="detailsTabContent">
                    <!-- Biodata Tab -->
                    <div class="tab-pane fade show active" id="biodata-tab-pane" role="tabpanel" aria-labelledby="biodata-tab" tabindex="0">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted mb-0">Nama Lengkap</label>
                                <div class="fw-bold" id="det-nama"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted mb-0">No. Identitas (KTP/KTM)</label>
                                <div class="fw-bold" id="det-identitas"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted mb-0">Tanggal Lahir</label>
                                <div class="fw-bold" id="det-lahir"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted mb-0">Jenis Kelamin</label>
                                <div class="fw-bold" id="det-kelamin"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted mb-0">Universitas</label>
                                <div class="fw-bold" id="det-universitas"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted mb-0">Fakultas / Semester</label>
                                <div class="fw-bold" id="det-fakultas-semester"></div>
                            </div>
                            <div class="col-md-12">
                                <label class="small text-muted mb-0">Alamat Tinggal</label>
                                <div class="fw-bold" id="det-alamat"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted mb-0">No. Telepon / HP</label>
                                <div class="fw-bold" id="det-telepon"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Parent Tab -->
                    <div class="tab-pane fade" id="parent-tab-pane" role="tabpanel" aria-labelledby="parent-tab" tabindex="0">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted mb-0">Nama Orang Tua / Wali</label>
                                <div class="fw-bold" id="det-ortu-nama"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted mb-0">Pekerjaan</label>
                                <div class="fw-bold" id="det-ortu-kerja"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted mb-0">No. Telepon Orang Tua</label>
                                <div class="fw-bold" id="det-ortu-telp"></div>
                            </div>
                            <div class="col-md-12">
                                <label class="small text-muted mb-0">Alamat Orang Tua</label>
                                <div class="fw-bold" id="det-ortu-alamat"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Intern Tab -->
                    <div class="tab-pane fade" id="intern-tab-pane" role="tabpanel" aria-labelledby="intern-tab" tabindex="0">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted mb-0">Dosen Pembimbing</label>
                                <div class="fw-bold" id="det-pembimbing"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted mb-0">No. Telepon Pembimbing</label>
                                <div class="fw-bold" id="det-pembimbing-telp"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="small text-muted mb-0">Durasi Magang</label>
                                <div class="fw-bold" id="det-durasi"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="small text-muted mb-0">Mulai Tanggal</label>
                                <div class="fw-bold" id="det-mulai"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="small text-muted mb-0">Sampai Tanggal</label>
                                <div class="fw-bold" id="det-sampai"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Scores Tab -->
                    <div class="tab-pane fade" id="scores-tab-pane" role="tabpanel" aria-labelledby="scores-tab" tabindex="0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Kategori</th>
                                        <th class="text-danger">D</th>
                                        <th class="text-warning">I</th>
                                        <th class="text-success">S</th>
                                        <th class="text-info">C</th>
                                        <th>*</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">MOST (Paling Sesuai)</td>
                                        <td id="score-d-m">0</td>
                                        <td id="score-i-m">0</td>
                                        <td id="score-s-m">0</td>
                                        <td id="score-c-m">0</td>
                                        <td id="score-star-m">0</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">LEAST (Paling Tidak Sesuai)</td>
                                        <td id="score-d-l">0</td>
                                        <td id="score-i-l">0</td>
                                        <td id="score-s-l">0</td>
                                        <td id="score-c-l">0</td>
                                        <td id="score-star-l">0</td>
                                    </tr>
                                    <tr class="table-light">
                                        <td class="fw-bold">CHANGE (Perubahan/Diri)</td>
                                        <td class="fw-bold text-danger" id="score-d-c">0</td>
                                        <td class="fw-bold text-warning-emphasis" id="score-i-c">0</td>
                                        <td class="fw-bold text-success" id="score-s-c">0</td>
                                        <td class="fw-bold text-info" id="score-c-c">0</td>
                                        <td class="table-secondary"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Personality Tab -->
                    <div class="tab-pane fade" id="personality-tab-pane" role="tabpanel" aria-labelledby="personality-tab" tabindex="0">
                        <div class="card border border-2 mb-3 shadow-sm" id="det-personality-card">
                            <div class="card-header fw-bold" style="font-size: 1rem;" id="det-personality-card-header">
                                {{ __('messages.personality_type') }}
                            </div>
                            <div class="card-body">
                                <span id="det-personality-badge" class="badge px-3 py-2 fs-5 fw-bold rounded-pill shadow-sm"></span>
                                <span id="det-personality-name" class="fs-4 fw-bold ms-2 align-middle"></span>
                            </div>
                        </div>

                        <div class="card border shadow-sm">
                            <div class="card-header bg-body-secondary fw-bold" style="font-size: 1rem;">
                                {{ __('messages.personality_explanation') }}
                            </div>
                            <div class="card-body fs-6" id="det-personality-desc" style="line-height: 1.6; text-align: justify; color: var(--bs-body-color);">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light border-0">
                <a href="#" id="modal-pdf-btn" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf me-1"></i> Buka PDF</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Doughnut Chart (Chart.js)
        @if($totalTests > 0)
            const ctx = document.getElementById('discDoughnutChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Dominance (D)', 'Influence (I)', 'Steadiness (S)', 'Compliance (C)'],
                    datasets: [{
                        data: [
                            {{ $dominants['D'] }},
                            {{ $dominants['I'] }},
                            {{ $dominants['S'] }},
                            {{ $dominants['C'] }}
                        ],
                        backgroundColor: ['#dc3545', '#ffc107', '#198754', '#0dcaf0'],
                        borderWidth: 1,
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                font: {
                                    size: 11
                                }
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
        @endif

        // Modal Detil Handler
        window.showDetailsModal = function(biodata, result) {
            // Reset ke tab pertama
            const firstTab = document.querySelector('#biodata-tab');
            if (firstTab) {
                const tabInstance = bootstrap.Tab.getOrCreateInstance(firstTab);
                tabInstance.show();
            }

            // Biodata
            document.getElementById('det-nama').innerText = biodata.nama_lengkap || '-';
            document.getElementById('det-identitas').innerText = biodata.no_identitas || '-';
            document.getElementById('det-lahir').innerText = biodata.tanggal_lahir || '-';
            document.getElementById('det-kelamin').innerText = biodata.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
            document.getElementById('det-universitas').innerText = biodata.universitas || '-';
            document.getElementById('det-fakultas-semester').innerText = (biodata.fakultas || '-') + ' / Semester ' + (biodata.semester || '-');
            document.getElementById('det-alamat').innerText = biodata.alamat || '-';
            document.getElementById('det-telepon').innerText = biodata.no_telepon || '-';

            // Orang tua
            document.getElementById('det-ortu-nama').innerText = biodata.nama_orang_tua || '-';
            document.getElementById('det-ortu-kerja').innerText = biodata.pekerjaan_orang_tua || '-';
            document.getElementById('det-ortu-telp').innerText = biodata.no_telepon_orang_tua || '-';
            document.getElementById('det-ortu-alamat').innerText = biodata.alamat_orang_tua || '-';

            // Magang
            document.getElementById('det-pembimbing').innerText = biodata.pembimbing || '-';
            document.getElementById('det-pembimbing-telp').innerText = biodata.no_telepon_pembimbing || '-';
            document.getElementById('det-durasi').innerText = biodata.durasi_magang || '-';
            document.getElementById('det-mulai').innerText = biodata.mulai || '-';
            document.getElementById('det-sampai').innerText = biodata.sampai || '-';

            // Skor
            document.getElementById('score-d-m').innerText = result.score_d_most;
            document.getElementById('score-i-m').innerText = result.score_i_most;
            document.getElementById('score-s-m').innerText = result.score_s_most;
            document.getElementById('score-c-m').innerText = result.score_c_most;
            document.getElementById('score-star-m').innerText = result.score_star_most;

            document.getElementById('score-d-l').innerText = result.score_d_least;
            document.getElementById('score-i-l').innerText = result.score_i_least;
            document.getElementById('score-s-l').innerText = result.score_s_least;
            document.getElementById('score-c-l').innerText = result.score_c_least;
            document.getElementById('score-star-l').innerText = result.score_star_least;

            document.getElementById('score-d-c').innerText = result.score_d_change;
            document.getElementById('score-i-c').innerText = result.score_i_change;
            document.getElementById('score-s-c').innerText = result.score_s_change;
            document.getElementById('score-c-c').innerText = result.score_c_change;

            // Hitung Kepribadian Dominan
            const personalityInfo = {
                'D': {
                    name: @json(__('messages.dominance_name')),
                    desc: @json(__('messages.dominance_desc')),
                    badge: 'bg-danger',
                    color: '#dc3545'
                },
                'I': {
                    name: @json(__('messages.influence_name')),
                    desc: @json(__('messages.influence_desc')),
                    badge: 'bg-warning text-dark',
                    color: '#ffc107'
                },
                'S': {
                    name: @json(__('messages.steadiness_name')),
                    desc: @json(__('messages.steadiness_desc')),
                    badge: 'bg-success',
                    color: '#198754'
                },
                'C': {
                    name: @json(__('messages.compliance_name')),
                    desc: @json(__('messages.compliance_desc')),
                    badge: 'bg-info text-dark',
                    color: '#0dcaf0'
                }
            };

            const scores = {
                'D': parseInt(result.score_d_change) || 0,
                'I': parseInt(result.score_i_change) || 0,
                'S': parseInt(result.score_s_change) || 0,
                'C': parseInt(result.score_c_change) || 0
            };
            const dominant = Object.keys(scores).reduce((a, b) => scores[a] > scores[b] ? a : b);
            const pInfo = personalityInfo[dominant];

            // Tampilkan Detail Kepribadian
            document.getElementById('det-personality-badge').className = `badge ${pInfo.badge} px-3 py-2 fs-5 fw-bold rounded-pill shadow-sm`;
            document.getElementById('det-personality-badge').innerText = dominant;
            document.getElementById('det-personality-name').innerText = pInfo.name;
            document.getElementById('det-personality-desc').innerText = pInfo.desc;
            
            const cardHeader = document.getElementById('det-personality-card-header');
            const cardEl = document.getElementById('det-personality-card');
            cardHeader.style.color = pInfo.color;
            cardEl.style.borderColor = pInfo.color;

            // Link PDF
            document.getElementById('modal-pdf-btn').href = '{{ url("/psikotes/pdf") }}/' + result.id;

            // Tampilkan modal
            const myModal = new bootstrap.Modal(document.getElementById('detailsModal'));
            myModal.show();
        };

        // Hapus Data Handler
        window.deleteResult = function(id) {
            if(confirm("Apakah Anda yakin ingin menghapus data hasil psikotes ini? Tindakan ini juga akan menghapus data biodata terkait dan tidak dapat dibatalkan.")) {
                $.ajax({
                    url: '{{ url("/psikotes") }}/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        if(res.success) {
                            alert(res.message);
                            $('#row-' + id).fadeOut(300, function() {
                                $(this).remove();
                                location.reload(); // Muat ulang halaman untuk memperbarui total & statistik
                            });
                        } else {
                            alert(res.message);
                        }
                    },
                    error: function(err) {
                        alert("Terjadi kesalahan saat menghapus data. Silakan coba lagi.");
                        console.error(err);
                    }
                });
            }
        };
    });
</script>
@endpush
