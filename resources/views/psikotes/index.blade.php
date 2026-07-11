@extends('layouts.guest')

@section('title', 'Psikotes DISC | EQUITYWORLD FUTURES')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-10">
        <div class="card card-primary card-outline" style="border-top: 3px solid #fd7e14;">
            <div class="card-body mt-2">
                <!-- Progress Bar Modern -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold text-muted small" id="progress-step-label"><i class="fas fa-user-edit me-1 text-warning"></i> {{ __('messages.form') }}</span>
                        <span class="badge bg-warning-subtle text-warning fw-bold border border-warning border-opacity-25 px-2 py-1 fs-6" id="progress-pct-label">5%</span>
                    </div>
                    <div class="progress-bar-container" style="background-color: var(--bs-tertiary-bg); border-radius: 50px; padding: 4px; border: 1px solid var(--bs-border-color);">
                        <div id="test-progress" class="progress-bar-fill" style="width: 5%; height: 12px; background: linear-gradient(90deg, #fd7e14 0%, #ff9f43 100%); border-radius: 50px; transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 2px 6px rgba(253, 126, 20, 0.2);"></div>
                    </div>
                </div>

                <form id="psikotes-form">
                    @csrf
                    
                    <!-- LANGKAH 0: Formulir Magang -->
                    <div class="psychotest-step transition-smooth active" id="step-0">
                        <p class="text-center text-muted mb-4">{{ __('messages.complete_data') }}</p>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>{{ __('messages.full_name') }}</label>
                                <input type="text" name="nama_lengkap" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>{{ __('messages.identity_no') }}</label>
                                <input type="text" name="no_identitas" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>{{ __('messages.dob') }}</label>
                                <input type="date" name="tanggal_lahir" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>{{ __('messages.gender') }}</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="">{{ __('messages.choose') }}</option>
                                    <option value="L">{{ __('messages.male') }}</option>
                                    <option value="P">{{ __('messages.female') }}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>{{ __('messages.faculty') }}</label>
                                <input type="text" name="fakultas" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>{{ __('messages.semester') }}</label>
                                <input type="text" name="semester" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label>{{ __('messages.university') }}</label>
                                <input type="text" name="universitas" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label>{{ __('messages.address') }}</label>
                                <textarea name="alamat" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label>{{ __('messages.phone') }}</label>
                                <input type="text" name="no_telepon" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>{{ __('messages.parents_name') }}</label>
                                <input type="text" name="nama_orang_tua" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>{{ __('messages.parents_job') }}</label>
                                <input type="text" name="pekerjaan_orang_tua" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>{{ __('messages.parents_phone') }}</label>
                                <input type="text" name="no_telepon_orang_tua" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label>{{ __('messages.parents_address') }}</label>
                                <textarea name="alamat_orang_tua" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label>{{ __('messages.advisor') }}</label>
                                <input type="text" name="pembimbing" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>{{ __('messages.advisor_phone') }}</label>
                                <input type="text" name="no_telepon_pembimbing" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>{{ __('messages.intern_duration') }}</label>
                                <input type="text" name="durasi_magang" class="form-control" placeholder="{{ __('messages.intern_duration_ph') }}">
                            </div>
                            <div class="col-md-4">
                                <label>{{ __('messages.start_date') }}</label>
                                <input type="date" name="mulai" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label>{{ __('messages.end_date') }}</label>
                                <input type="date" name="sampai" class="form-control" required>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="button" class="btn btn-warning btn-next text-white fw-bold" data-target="step-1" style="background-color: #fd7e14; border-color: #fd7e14;">{{ __('messages.start_test') }} <i class="fas fa-arrow-right ms-2"></i></button>
                        </div>
                    </div>

                    <!-- LANGKAH PERTANYAAN -->
                    @foreach($questions as $q)
                    <div class="psychotest-step transition-smooth d-none" id="step-{{ $q->question_number }}">
                        <h4 class="text-center mb-4 fw-bold">{{ str_replace([':current', ':total'], [$q->question_number, 24], __('messages.question_x_of_y')) }}</h4>
                        
                        <p class="text-center text-muted">{!! __('messages.choose_statement') !!}</p>

                        <div class="table-responsive">
                            <table class="table table-bordered text-center align-middle" style="border-color: var(--bs-border-color);">
                                <thead style="background-color: var(--bs-tertiary-bg);">
                                    <tr>
                                        <th width="15%" class="text-success"><i class="fas fa-plus-circle"></i> MOST</th>
                                        <th style="color: var(--bs-body-color);">{{ __('messages.statement') }}</th>
                                        <th width="15%" class="text-danger"><i class="fas fa-minus-circle"></i> LEAST</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($q->options as $opt)
                                    <tr>
                                        <td class="text-center align-middle" onclick="if(!$(this).find('input').prop('disabled')) { $(this).find('input').prop('checked', true).trigger('change'); }" style="cursor: pointer;">
                                            <input type="radio" name="most_{{ $q->question_number }}" value="{{ $opt->id }}" class="form-check-input most-radio" style="transform: scale(1.5); cursor: pointer;">
                                        </td>
                                        <td class="text-start fs-5">{{ $opt->option_text }}</td>
                                        <td class="text-center align-middle" onclick="if(!$(this).find('input').prop('disabled')) { $(this).find('input').prop('checked', true).trigger('change'); }" style="cursor: pointer;">
                                            <input type="radio" name="least_{{ $q->question_number }}" value="{{ $opt->id }}" class="form-check-input least-radio" style="transform: scale(1.5); cursor: pointer;">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary btn-prev" data-target="step-{{ $q->question_number - 1 }}"><i class="fas fa-arrow-left ms-2"></i> {{ __('messages.previous') }}</button>
                            
                            @if($q->question_number < 24)
                            <button type="button" class="btn btn-warning btn-next text-white fw-bold" data-target="step-{{ $q->question_number + 1 }}" style="background-color: #fd7e14; border-color: #fd7e14;">{{ __('messages.next') }} <i class="fas fa-arrow-right ms-2"></i></button>
                            @else
                            <button type="submit" class="btn btn-success fw-bold" id="btn-submit"><i class="fas fa-save ms-2"></i> {{ __('messages.finish_save') }}</button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </form>
            </div>
            
            <!-- Peringatan keberhasilan pengiriman -->
            <div id="success-alert" class="card-body d-none">
                <div class="alert alert-success text-center p-4">
                    <h3 class="fw-bold mb-3"><i class="icon fas fa-check-circle fa-2x mb-3"></i><br>{{ __('messages.test_completed') }}</h3>
                    <p class="fs-5">{{ __('messages.thank_you') }}</p>
                    <div class="mt-4">
                        <a href="#" id="download-pdf-btn" class="btn btn-danger btn-lg px-4 shadow-sm" target="_blank"><i class="fas fa-file-pdf ms-2"></i> {{ __('messages.print_result') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const totalSteps = 24; // Formulir + 24 Pertanyaan = 25 langkah secara konseptual, tapi progres untuk pertanyaan
        
        function updateProgress(currentStepId) {
            let stepNum = parseInt(currentStepId.replace('step-', ''));
            if(stepNum === 0) {
                $('#test-progress').css('width', '5%');
                $('#progress-step-label').html('<i class="fas fa-user-edit me-1 text-warning"></i> ' + @json(__('messages.form')));
                $('#progress-pct-label').text('5%');
            } else {
                let pct = Math.round((stepNum / totalSteps) * 100);
                $('#test-progress').css('width', pct + '%');
                
                let text = @json(__('messages.question_x_of_y'))
                    .replace(':current', stepNum)
                    .replace(':total', totalSteps);
                $('#progress-step-label').html('<i class="fas fa-file-alt me-1 text-warning"></i> ' + text);
                $('#progress-pct-label').text(pct + '%');
            }
        }

        // Pulihkan dari penyimpanan sesi (sessionStorage)
        let savedData = JSON.parse(sessionStorage.getItem('psikotes_data') || '{}');
        $.each(savedData, function(name, val) {
            let $el = $('[name="' + name + '"]');
            if ($el.is(':radio')) {
                $el.filter('[value="' + val + '"]').prop('checked', true);
            } else {
                $el.val(val);
            }
        });
        
        let savedStep = sessionStorage.getItem('psikotes_current_step') || 'step-0';
        $('.psychotest-step').addClass('d-none').removeClass('active');
        $('#' + savedStep).removeClass('d-none').addClass('active');
        updateProgress(savedStep);

        // Simpan data saat ada perubahan
        $('#psikotes-form').on('change input', 'input, select, textarea', function() {
            $(this).removeClass('is-invalid');
            let data = {};
            $('#psikotes-form').serializeArray().forEach(function(item) {
                data[item.name] = item.value;
            });
            sessionStorage.setItem('psikotes_data', JSON.stringify(data));
        });

        function updateDisabledRadios() {
            // Aktifkan kembali semua terlebih dahulu
            $('.most-radio, .least-radio').prop('disabled', false).closest('td').removeClass('bg-secondary bg-opacity-10');
            
            // Nonaktifkan radio LEAST yang cocok dengan MOST yang dipilih
            $('.most-radio:checked').each(function() {
                let qNum = $(this).attr('name').split('_')[1];
                let val = $(this).val();
                let leastRadio = $(`input[name="least_${qNum}"][value="${val}"]`);
                leastRadio.prop('checked', false).prop('disabled', true);
            });
            
            // Nonaktifkan radio MOST yang cocok dengan LEAST yang dipilih
            $('.least-radio:checked').each(function() {
                let qNum = $(this).attr('name').split('_')[1];
                let val = $(this).val();
                let mostRadio = $(`input[name="most_${qNum}"][value="${val}"]`);
                mostRadio.prop('checked', false).prop('disabled', true);
            });
        }

        // Jalankan saat dimuat dan saat ada perubahan
        updateDisabledRadios();
        $('.most-radio, .least-radio').change(function() {
            updateDisabledRadios();
        });

        $('.btn-next').click(function() {
            let currentStep = $(this).closest('.psychotest-step');
            let targetId = $(this).data('target');
            let qNum = parseInt(currentStep.attr('id').replace('step-', ''));

            // Logika validasi
            if(qNum === 0) {
                // Validasi formulir
                let isValid = true;
                currentStep.find('input[required], select[required], textarea[required]').each(function() {
                    if(!$(this).val()) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                if(!isValid) {
                    alert("{{ __('messages.validation_form') }}");
                    return;
                }
            } else {
                // Validasi radio
                let mostChecked = $(`input[name="most_${qNum}"]:checked`).length;
                let leastChecked = $(`input[name="least_${qNum}"]:checked`).length;
                if(mostChecked === 0 || leastChecked === 0) {
                    alert("{{ __('messages.validation_radio') }}");
                    return;
                }
            }
            
            currentStep.addClass('d-none').removeClass('active');
            $('#' + targetId).removeClass('d-none').addClass('active');
            updateProgress(targetId);
            window.scrollTo(0,0);
        });

        $('.btn-prev').click(function() {
            let currentStep = $(this).closest('.psychotest-step');
            let targetId = $(this).data('target');
            
            currentStep.addClass('d-none').removeClass('active');
            $('#' + targetId).removeClass('d-none').addClass('active');
            updateProgress(targetId);
            sessionStorage.setItem('psikotes_current_step', targetId);
            window.scrollTo(0,0);
        });

        $('#psikotes-form').submit(function(e) {
            e.preventDefault();
            
            let qNum = 24;
            let mostChecked = $(`input[name="most_${qNum}"]:checked`).length;
            let leastChecked = $(`input[name="least_${qNum}"]:checked`).length;
            if(mostChecked === 0 || leastChecked === 0) {
                alert("{{ __('messages.validation_radio') }}");
                return;
            }

            let btn = $('#btn-submit');
            let originalHtml = btn.html();
            btn.html('<i class="fas fa-spinner fa-spin ms-2"></i> {{ __("messages.saving") }}').prop('disabled', true);

            $.ajax({
                url: '{{ url("/psikotes/submit") }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(res) {
                    if(res.success) {
                        // Hapus penyimpanan sesi
                        sessionStorage.removeItem('psikotes_current_step');
                        sessionStorage.removeItem('psikotes_data');

                        $('#psikotes-form').hide();
                        $('#success-alert').removeClass('d-none');
                        $('#progress-step-label').html('<i class="fas fa-check-circle me-1 text-success"></i> ' + @json(__('messages.finished')));
                        $('#progress-pct-label').text('100%').removeClass('bg-warning-subtle text-warning border-warning').addClass('bg-success-subtle text-success border-success');
                        $('#test-progress').css({
                            'width': '100%',
                            'background': 'linear-gradient(90deg, #28a745 0%, #20c997 100%)'
                        }).text('');
                        
                        // Atur tautan unduhan
                        $('#download-pdf-btn').attr('href', '{{ url("/psikotes/pdf") }}/' + res.result_id);
                    }
                },
                error: function(err) {
                    let errMsg = '{{ __("messages.error_save") }}';
                    if(err.responseJSON && err.responseJSON.message) {
                        errMsg = err.responseJSON.message;
                    }
                    alert(errMsg);
                    btn.html(originalHtml).prop('disabled', false);
                    console.error(err);
                }
            });
        });
    });
</script>
@endpush
