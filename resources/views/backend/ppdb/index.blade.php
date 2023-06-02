@extends('backend.layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header justify-content-between">
            <h4>List {{$title}}</h4>
        </div>
        <div class="card-body row">
            <div class="col s12">
                <table id="table-student" class="display">
                    <thead>
                        <th>No. Pendataran</th>
                        <th>Jalur</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat, Tanggal Lahir</th>
                        <th>Status</th>
                        <th>Tanggal Pendaftaran</th>
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

        $('#table-student').DataTable({
            responsive: true,
            scrollY: '50vh',
            scrollCollapse: true,
            paging: true,
            searchable: true,
            // processing: true,
            serverSide: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            columnDefs: [
                {
                    className: "dt-center",
                    targets: [6]
                },
                {
                    targets: '_all',
                    defaultContent: "N/A",
                }
            ],
            ajax: {
                url: "{{ route('be.ppdb.json') }}",
                method: 'get'
            },
            columns: [
                {
                    data: 'registration_number',
                    name: 'registration_number',
                },
                {
                    data: 'type',
                    name: 'type',
                },
                {
                    data: 'fullname',
                    name: 'fullname',
                },
                {
                    data: 'gender',
                    name: 'gender',
                },
                {
                    data: 'dob',
                    name: 'dob'
                },
                {
                    data: 'status',
                    name: 'status'
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
    })
</script>
@endpush