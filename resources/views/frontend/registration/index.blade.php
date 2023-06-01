@extends('frontend.layouts.app')
@section('content')

@push('styles')
    <link href="{{ asset('assets/library/smart-wizard/dist/css/smart_wizard_all.css') }}" rel="stylesheet" type="text/css" />
@endpush
<div class="row">
    <div class="col-sm-12">
        <h2 align="center">Form Pendaftaran</h2>
        <h5>Catatan:</h5>
        <span class="text-primary text-italic text-bold" style="font-size: 80%;">*Tanda (<span class="text-danger">*</span>) wajib diisi</span><br>
        <span class="text-primary text-italic text-bold" style="font-size: 80%;">*Max. ukuran file: 2Mb</span><br>
        <span class="text-primary text-italic text-bold" style="font-size: 80%;">*Rekomendasi format dokumen: *.pdf</span>
        <div id="smartwizard" dir="rtl-" class="mt-2">
            <ul class="nav nav-progress">
                <li class="nav-item">
                    <a class="nav-link" href="#step-1">
                        <div class="num"><i class="fa fa-address-card"></i></div>
                        Data Siswa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step-2">
                        <span class="num"><i class="fa fa-id-card"></i></span>
                        Data Orang Tua
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step-3">
                        <span class="num"><i class="fa fa-user-shield"></i></span>
                        Data Wali
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step-4">
                        <span class="num"><i class="fa fa-file-lines"></i></span>
                        Dokumen
                    </a>
                </li>
            </ul>

            <div class="tab-content card" style="overflow-y: scroll;">
                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                    @include('frontend.registration.form.step-1')
                </div>
                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                    @include('frontend.registration.form.step-2')
                </div>
                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                    @include('frontend.registration.form.step-3')
                </div>
                <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                    @include('frontend.registration.form.step-4')
                </div>
            </div>

            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Order Placed</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Congratulations! Your order is placed.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="closeModal()">Ok, close and reset</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript" src="{{ asset('assets/library/smart-wizard/dist/js/jquery.smartWizard.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Leave step event is used for validating the forms
        $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
            // Validate only on forward movement  
            if (stepDirection == 'forward') {
                let form = document.getElementById('form-' + (currentStepIdx + 1));
                if (form) {
                    if (!form.checkValidity()) {
                        form.classList.add('was-validated');
                        $('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        $("#smartwizard").smartWizard('');
                        return false;
                    }
                    $('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                }
            }
        });

        // Step show event
        $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
            $("#prev-btn").removeClass('disabled').prop('disabled', false);
            $("#next-btn").removeClass('disabled').prop('disabled', false);
            if(stepPosition === 'first') {
                $("#prev-btn").addClass('disabled').prop('disabled', true);
                $(".sw-btn-prev").hide()
                // $(".sw-btn-prev").addClass('disabled').prop('disabled', true).attr('cursor', 'none !important');
            } else if(stepPosition === 'last') {
                $("#next-btn").addClass('disabled').prop('disabled', true);
                $(".sw-btn-prev").show()
            } else {
                $("#prev-btn").removeClass('disabled').prop('disabled', false);
                $("#next-btn").removeClass('disabled').prop('disabled', false);
                $(".sw-btn-prev").show()
            }

            // Get step info from Smart Wizard
            let stepInfo = $('#smartwizard').smartWizard("getStepInfo");
            $("#sw-current-step").text(stepInfo.currentStep + 1);
            $("#sw-total-step").text(stepInfo.totalSteps);

            if (stepPosition == 'last') {
                $("#btnFinish").prop('disabled', false);
                $("#btnFinish").show();
                $(".sw-btn-next").hide();
            } else {
                $("#btnFinish").prop('disabled', true);
                $("#btnFinish").hide();
                $(".sw-btn-next").show();
            }

            // Focus first name
            if (stepIndex == 1) {
                setTimeout(() => {
                    $('#fullname').focus();
                }, 0);
            }
        });

        // Smart Wizard
        $('#smartwizard').smartWizard({
            selected: 0,
            autoAdjustHeight: true,
            theme: 'arrows', // basic, arrows, square, round, dots
            transition: {
                animation:'none'
            },
            toolbar: {
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button
                position: 'bottom', // none/ top/ both bottom
                extraHtml: `<button class="btn btn-info" id="btnFinish" disabled style="display: none;"><i class="fa fa-save"></i> Daftar Sekarang</button>`
                          //`<button class="btn btn-danger" id="btnCancel" onclick="onCancel()">Cancel</button>`
            },
            anchor: {
                enableNavigation: true, // Enable/Disable anchor navigation 
                enableNavigationAlways: false, // Activates all anchors clickable always
                enableDoneState: true, // Add done state on visited steps
                markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                unDoneOnBackNavigation: true, // While navigate back, done state will be cleared
                enableDoneStateNavigation: true // Enable/Disable the done state navigation
            },
            keyboard: {
                keyNavigation: false, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
            },
        });

        $("#state_selector").on("change", function() {
            $('#smartwizard').smartWizard("setState", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
            return true;
        });

        $("#style_selector").on("change", function() {
            $('#smartwizard').smartWizard("setStyle", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
            return true;
        });

        isAlive()
        $(".selectgroup-input").change(function() {
            isAlive()
        });

        $('.dob').daterangepicker({
            locale: {format: 'YYYY-MM-DD'},
            singleDatePicker: true,
            autoApply: true,
            maxDate: moment(),
            showDropdowns: true,
        });

        $('.input-number').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                numeralPositiveOnly: true,
                numeralDecimalScale: 0,
                numeralDecimalMark: ',',
                delimiter: '.',
            });
        });

        $('body').on('click', '#btnFinish', function () {
            var btn = $(this)
            let form = document.getElementById('form-4');
            // if (form) {
                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    $('#smartwizard').smartWizard("setState", [3], 'error');
                    // $("#smartwizard").smartWizard();
                    return false;
                }

                $('#smartwizard').smartWizard("unsetState", [3], 'error');
                $('#smartwizard').smartWizard("goToStep", 3, true);

                var fd = new FormData();
                // fd.append('file', $('#file')[0].files[0])

                var form1 = $('#form-1').serializeArray();
                var form2 = $('#form-2').serializeArray();
                var form3 = $('#form-3').serializeArray();
                var form4 = $('#form-4');

                if ("{{ Request::routeIs('fe.registration.zonasi') }}") {
                    fd.append('type', '1');
                } else {
                    fd.append('type', '2');
                }

                $.each(form1,function(key,input){
                    fd.append(input.name, input.value);
                });

                $.each(form2,function(key,input){
                    fd.append(input.name, input.value);
                });

                $.each(form3,function(key,input){
                    fd.append(input.name, input.value);
                });

                form4.find("input[type=file]").each(function(key, input){
                    fd.append(input.name, input.files[0] ? input.files[0] : '');
                });

                form4.find("input[type=text]").each(function(key, input){
                    fd.append(input.name, input.value);
                });

                swal({
                    title: 'Perhatikan',
                    text: 'Apa anda yakin data yang diisi sudah benar?',
                    icon: 'warning',
                    buttons: {
                        cancel : 'Cek Kembali',
                        confirm : {text:'Yakin',className:'btn-primary'},
                    },
                    dangerMode: true,
                })
                .then((save) => {
                    if (save) {
                        $.ajax({
                            url: "{{ route('fe.registration.post') }}",
                            data: fd,
                            cache: false,
                            contentType: false,
                            processData: false,
                            type: 'POST',
                            beforeSend: function () {
                               btn.addClass('disabled btn-progress')
                            },
                            success: function(response){
                                // console.log(response);
                                if (response.status) {
                                    swal('Success', response.message, 'success')
                                    setTimeout(() => {
                                        location.href = "{{ url('status-pendaftaran') }}" + '/' + response.data.registration_number
                                    }, 1000);
                                } else {
                                    // $('#'+response.step).click()
                                    $('#smartwizard').smartWizard("setState", [response.step-1], 'error');
                                    $('#smartwizard').smartWizard("goToStep", response.step-1, true);
                                    $('#form'+response.step).removeClass('was-validated')
                                    $.each(response.errors, function (key, item) {
                                        key = key.replace('.', '_')
                                        key = key.replace('_*', '')
                                        if (item) {
                                            $('#form'+response.step+'-'+key).addClass('is-invalid')
                                            $('#form'+response.step+'-'+key).removeClass('is-valid')
                                            $('#form'+response.step+'-message-'+key).removeClass('valid-feedback')
                                            $('#form'+response.step+'-message-'+key).addClass('invalid-feedback')
                                            $('#form'+response.step+'-message-'+key).html(item[0])
                                        } else {
                                            $('#form'+response.step+'-'+key).removeClass('is-invalid')
                                            $('#form'+response.step+'-'+key).addClass('is-valid')
                                            $('#form'+response.step+'-message-'+key).removeClass('invalid-feedback')
                                            $('#form'+response.step+'-message-'+key).addClass('valid-feedback')
                                            $('#form'+response.step+'-message-'+key).html('Ok.')
                                        }
                                    })
                                    swal('Failed', response.message, 'error')
                                }
                            },
                            error: function(xhr, AbsenceType, error) {
                                swal('Failed', xhr.responseJSON.message, 'error')
                            },
                            complete: function () {
                               btn.removeClass('disabled btn-progress')
                            },
                        });
                    } else {
                        swal('Perhatikan!', 'Pastikan anda mengisi data dengan benar!', 'info');
                    }
                });
            // }
        })

        $('body').on('change', '.custom-file-input', function () {
            var reader = new FileReader();
            var input = this;
            var id = $(this).attr('id');

            if (input.files[0]) {
                $('#image-label-'+id).text(input.files[0].name)
            };
        })

        var disease_history = 1;
        $('.btn-add-disease').on('click', function () {
            var html = ''
            html += '<div class="input-group" id="new_disease_'+disease_history+'">'
                html += '<input type="text" class="form-control input-number" id="disease_history_'+disease_history+'" name="disease_history[]" placeholder="Masukkan Riwayat Penyakit">'
                html += '<div class="input-group-prepend">'
                    html += '<div class="input-group-text">'
                        html += '<button type="button" class="btn btn-outline-danger" onclick="removeDisease('+disease_history+')"><i class="fas fa-trash"></i></button>'
                    html += '</div>'
                html += '</div>'
            html += '</div>'
            $('.disease_history_field').append(html)
            disease_history++
        })

        // $('body').on('click', '.btn-delete-disease', function () {
        //     var id = $(this).data('id')
        //     $('#new_disease_'+id).remove()
        // })

        var count_certificate = 1;
        $('.btn-add-certificate').on('click', function () {
            var html = '<div class="row" id="new_certificate_'+count_certificate+'">'
                html += '<div class="form-group col-lg-6 col-sm-12">'
                    html += '<label for="form4-certificate_name_'+count_certificate+'" class="form-label">Nama Sertifikat</label>'
                    html += '<input type="text" class="form-control" id="form4-certificate_name_'+count_certificate+'" name="certificate_name[]" placeholder="Masukkan Nama Sertifikat" required>'
                    html += '<div class="" id="form4-message-certificate_name_'+count_certificate+'"></div>'
                html += '</div>'
                html += '<div class="form-group col-lg-5 col-sm-12">'
                    html += '<label for="form4-certificate_file_'+count_certificate+'" class="form-label">Sertifikat Prestasi</label>'
                    html += '<div class="input-group">'
                        html += '<input type="file" class="custom-file-input mb-2" name="certificate_file[]" id="form4-certificate_file_'+count_certificate+'" accept="image/*,application/pdf" required>'
                        html += '<label class="custom-file-label" for="image" id="image-label-form4-certificate_file_'+count_certificate+'">Choose File</label>'
                        html += '<div class="" id="form4-message-certificate_file_'+count_certificate+'"></div>'
                    html += '</div>'
                html += '</div>'
                html += '<div class="form-group col-lg-1 col-sm-12">'
                    html += '<label for="certificate_name" class="form-label">Hapus</label>'
                    html += '<button type="button" class="btn btn-outline-danger" onclick="removeCertificate('+count_certificate+')"><i class="fa fa-trash"></i></button>'
                html += '</div>'
            html += '</div>'
            $('.certificate_field').append(html)
            count_certificate++
        })
    });

    function removeDisease(id) {
        $('#new_disease_'+id).remove()
    }

    function removeCertificate(id) {
        $('#new_certificate_'+id).remove()
    }

    function isAlive() {
        if (!$('.alive1').is(":checked") && !$('.alive2').is(":checked")) {
            $('#form-3').find("input[type=text]").each(function(key, input){
                $(input).attr('required', true)
            });
            $('#form-3').find("span.text-danger").each(function(key, item){
                $(item).attr('hidden', false)
            });
        } else {
            $('#form-3').find("input[type=text]").each(function(key, input){
                $(input).attr('required', false)
            });
            $('#form-3').find("span.text-danger").each(function(key, item){
                $(item).attr('hidden', true)
            });
        }
    }

</script>
@endpush
@endsection
