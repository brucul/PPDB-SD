@extends('backend.layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header justify-content-between">
            <h4>List Operator</h4>
            <button type="button" data-toggle="modal" data-target="#createOperator" class="btn btn-primary">
                <i class="fa fa-plus me-0"></i> Tambah {{$title}}
            </button>
        </div>
        <div class="card-body row">
            <div class="col s12">
                <table id="table-user" class="display">
                    <thead>
                        <th>No</th>
                        <th width="100">Image</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Created Date</th>
                        <th width="100">Action</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@include('backend.user.modal')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#table-user').DataTable({
            responsive: true,
            scrollY: '50vh',
            scrollCollapse: true,
            paging: true,
            searchable: true,
            // processing: true,
            // serverSide: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            columnDefs: [
                {
                    className: "dt-center",
                    targets: [5]
                },
                {
                    targets: '_all',
                    defaultContent: "N/A",
                }
            ],
            ajax: {
                url: "{{ route('be.user.json') }}",
                method: 'get'
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                },
                {
                    data: 'image',
                    name: 'image',
                },
                {
                    data: 'username',
                    name: 'username',
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });

        $('#image').on('change', function () {
            var reader = new FileReader();
            var input = this;

            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
                $('#image-label').text(input.files[0].name)
            };

            reader.readAsDataURL(input.files[0]);
        })

        $('#edit-image').on('change', function () {
            var reader = new FileReader();
            var input = this;

            reader.onload = function (e) {
                $('#edit-preview').attr('src', e.target.result);
                $('#image-label-edit').text(input.files[0].name)
            };

            reader.readAsDataURL(input.files[0]);
        })

        $('#formOperatorAdd').submit( (e) => {
            e.preventDefault()

            $.ajax({
                url : "{{ route('be.user.store') }}",
                method : "post",
                cache : false,
                contentType: false,
                processData: false,
                data : new FormData($('#formOperatorAdd').get(0)),
                success : function(response) {
                    if(response.status) {
                        $('.close').click()
                        swal('Success', response.message, 'success')
                        $('#table-user').DataTable().ajax.reload()
                    } else {
                        $('#formOperatorAdd').removeClass('was-validated')
                        $('.text-warning').hide()
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

        $('#createOperator').on('hidden.bs.modal', function(e) {
            $('#formOperatorAdd').get(0).reset()
            $('#formOperatorAdd').removeClass('was-validated')
            $('#formOperatorAdd *').filter(':input').each(function () {
                $(this).removeClass('is-invalid')
                $(this).removeClass('is-valid')
            })
            $('#preview').attr('src', "{{ asset('assets/img/avatar/avatar-1.png') }}")
            $('#image-label').text('Choose Image')
            $('.text-warning').show()
        })

        $('#table-user tbody').on('click', 'button.btn-delete', function () {
            var id = $(this).data('id')
            var name = $(this).data('name')

            swal({
                title: 'Warning',
                text: 'Apa anda yakin menghapus '+name+'?',
                icon: 'warning',
                buttons: {
                    cancel : 'Cancel',
                    confirm : {text:'Delete',className:'btn-primary'},
                },
                dangerMode: true,
            })
            .then((save) => {
                if (save) {
                    $.ajax({
                        url : "{{ url('admin/user/') }}" + '/' + id,
                        method : "delete",
                        cache : false,
                        success : function(response) {
                            if(response.status) {
                                $('#table-user').DataTable().ajax.reload()
                                swal('Success', response.message, 'success')
                            } else {
                                swal('Failed', 'Delete data failed', 'error')
                            }
                        },
                        error: function(xhr, AbsenceType, error) {
                            swal("Failed", xhr.responseJSON.message, "error")
                        }
                    })
                } else {
                    swal('OK', 'Delete data canceled', 'info');
                }
            });
        })

        $('#editOperator').on('hidden.bs.modal', function(e) {
            $('#formOperatorEdit').get(0).reset()
            $('#formOperatorEdit').removeClass('was-validated')
            $('#formOperatorEdit *').filter(':input').each(function () {
                $(this).removeClass('is-invalid')
                $(this).removeClass('is-valid')
            })
            $('#edit-preview').attr('src', "{{ asset('assets/img/avatar/avatar-1.png') }}")
            $('#image-label-edit').text('Choose Image')
            $('.text-warning').show()
        })
        
        $('#editOperator').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id')

            $.ajax({
                url : "{{ url('admin/user') }}" + '/' + id,
                method : "get",
                success : function(response) {
                    $('#id').val(id)
                    $('#edit-name').val(response.data.name)
                    $('#edit-username').val(response.data.username)
                    if (response.data.image) {
                        $('#edit-preview').attr("src", "{{asset('storage/user/images/')}}"+'/'+response.data.image)
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

        $('#formOperatorEdit').submit( (e) => {
            e.preventDefault()

            $.ajax({
                url : "{{ url('admin/user/update') }}",
                method : "post",
                cache : false,
                contentType: false,
                processData: false,
                data : new FormData($('#formOperatorEdit').get(0)),
                success : function(response) {
                    if(response.status) {
                        $('.close').click()
                        swal('Success', response.message, 'success')
                        $('#table-user').DataTable().ajax.reload()
                    } else {
                        $('#formOperatorEdit').removeClass('was-validated')
                        $('.text-warning').hide()
                        $.each(response.errors, function (key, item) {
                            if (item) {
                                $('#edit-'+key).addClass('is-invalid')
                                $('#edit-'+key).removeClass('is-valid')
                                $('#edit-message-'+key).removeClass('valid-feedback')
                                $('#edit-message-'+key).addClass('invalid-feedback')
                                $('#edit-message-'+key).html(item[0])
                            } else {
                                $('#edit-'+key).removeClass('is-invalid')
                                $('#edit-'+key).addClass('is-valid')
                                $('#edit-message-'+key).removeClass('invalid-feedback')
                                $('#edit-message-'+key).addClass('valid-feedback')
                                $('#edit-message-'+key).html('Looks good.')
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
    })
</script>
@endpush