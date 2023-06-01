@extends('backend.layouts.app')
@section('content')
<div class="col-12 mb-4">
    <div class="card">
        
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4">
                        <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="setting-tab" data-toggle="tab" href="#setting" role="tab" aria-controls="setting" aria-selected="true">Pengaturan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="instruction-tab" data-toggle="tab" href="#instruction" role="tab" aria-controls="instruction" aria-selected="false">Petunjuk PPDB</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8">
                        <div class="tab-content no-padding" id="myTab2Content">
                            <div class="tab-pane fade active show" id="setting" role="tabpanel" aria-labelledby="setting-tab">
                                <form action="{{ route('be.setting.update') }}" method="post" enctype="multipart/form-data" class="needs-validation row" novalidate="" id="setting-form">
                                    @csrf
                                    <div class="col-lg-12 col-sm-12">
                                        <h4 class="text-primary">Sekolah</h4>
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label for="school_name">Nama Sekolah<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Masukkan Nama Sekolah" name="school_name" id="school_name" value="{{ !$setting ? null : $setting->school_name }}" required>
                                        <div class="" id="message-school_name"></div>
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label for="school_year">Tahun Ajaran<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="YYYY/YYYY" name="school_year" id="school_year" value="{{ !$setting ? null : $setting->school_year }}" required>
                                        <div class="" id="message-school_year"></div>
                                    </div>
                                    <div class="form-group col-lg-12 col-sm-12">
                                        <label for="school_address">Alamat Sekolah<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Masukkan Alamat Sekolah" name="school_address" id="school_address" value="{{ !$setting ? null : $setting->school_address }}" required>
                                        <div class="" id="message-school_address"></div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12">
                                        <h4 class="text-primary">Pendaftaran</h4>
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label for="start_date">Tanggal Dibuka<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="start_date" id="start_date" value="{{ !$setting ? null : $setting->start_date }}" required>
                                        <div class="" id="message-start_date"></div>
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label for="end_date">Tanggal Ditutup<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="end_date" id="end_date" value="{{ !$setting ? null : $setting->end_date }}" required>
                                        <div class="" id="message-end_date"></div>
                                    </div>
                                    <div class="form-group col-lg-4 col-sm-12">
                                        <label for="registration_quota">Kuota Pendaftaran<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="Masukkan Kuota Pendaftaran" name="registration_quota" id="registration_quota" value="{{ !$setting ? null : $setting->registration_quota }}" min="1" required>
                                        <div class="" id="message-registration_quota"></div>
                                    </div>
                                    <div class="form-group col-lg-4 col-sm-12">
                                        <label for="zonasi_quota">Kuota Zonasi<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="Masukkan Kuota Zonasi" name="zonasi_quota" id="zonasi_quota" value="{{ !$setting ? null : $setting->zonasi_quota }}" min="0" required>
                                        <div class="" id="message-zonasi_quota"></div>
                                    </div>
                                    <div class="form-group col-lg-4 col-sm-12">
                                        <label for="prestasi_quota">Kuota Prestasi<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="Masukkan Kuota Prestasi" name="prestasi_quota" id="prestasi_quota" value="{{ !$setting ? null : $setting->prestasi_quota }}" min="0" required>
                                        <div class="" id="message-prestasi_quota"></div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12" align="right">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="instruction" role="tabpanel" aria-labelledby="instruction-tab">
                                <form action="" method="post" class="row" id="instruction-form">
                                    <div class="col-lg-12 col-sm-12">
                                        <textarea name="instruction" class="form-control summernote" id="instruction">{{ !$setting ? null : $setting->instruction }}</textarea>
                                    </div>
                                    <div class="col-lg-12 col-sm-12" align="right">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#start_date, #end_date').daterangepicker({
            locale: {format: 'YYYY-MM-DD'},
            singleDatePicker: true,
            autoApply: true,
            minDate: moment(),
        });

        new Cleave('#school_year', {
            delimiter: '/',
            blocks: [4, 4],
            numericOnly: true,
        });

        $('#setting-form').submit( (e) => {
            e.preventDefault()

            $.ajax({
                url : "{{ route('be.setting.update') }}",
                method : "post",
                cache : false,
                contentType: false,
                processData: false,
                data : new FormData($('#setting-form').get(0)),
                success : function(response) {
                    if(response.status) {
                        swal('Success', response.message, 'success')
                        $('#setting-form').removeClass('was-validated')
                        $.each(response.errors, function (key, item) {
                            $('#'+key).removeClass('is-valid')
                            $('#'+key).removeClass('is-invalid')
                            $('#message-'+key).removeClass('valid-feedback')
                            $('#message-'+key).removeClass('invalid-feedback')
                        })
                    } else {
                        $('#setting-form').removeClass('was-validated')
                        $.each(response.errors, function (key, item) {
                            if (item) {
                                $('#'+key).addClass('is-invalid')
                                $('#'+key).removeClass('is-valid')
                                $('#message-'+key).removeClass('valid-feedback')
                                $('#message-'+key).addClass('invalid-feedback')
                                $('#message-'+key).html(item[0])
                            } else {
                                $('#'+key).removeClass('is-invalid')
                                $('#'+key).addClass('is-valid')
                                $('#message-'+key).removeClass('invalid-feedback')
                                $('#message-'+key).addClass('valid-feedback')
                                $('#message-'+key).html('Looks good.')
                            }
                        })
                        // swal('Error', response.message, 'error')
                    }
                },
                error: function(xhr, AbsenceType, error) {
                    $.each(xhr.responseJSON.errors, function (key, item){
                        iziToast.error({
                            title: 'Error',
                            message: item,
                            position: 'topRight'
                        })
                    })
                }
            })
        })

        $('#instruction-form').submit( (e) => {
            e.preventDefault()

            $.ajax({
                url : "{{ route('be.setting.update-instruction') }}",
                method : "post",
                cache : false,
                contentType: false,
                processData: false,
                data : new FormData($('#instruction-form').get(0)),
                success : function(response) {
                    if(response.status) {
                        swal('Success', response.message, 'success')
                    } else {
                        swal('Error', response.message, 'error')
                    }
                },
                error: function(xhr, AbsenceType, error) {
                    $.each(xhr.responseJSON.errors, function (key, item){
                        iziToast.error({
                            title: 'Error',
                            message: item,
                            position: 'topRight'
                        })
                    })
                }
            })
        })
    })
</script>
@endpush