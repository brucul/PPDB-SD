@extends('backend.layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header justify-content-between">
            <h4>List Activity Log</h4>
        </div>
        <div class="card-body row">
            <div class="col s12">
                <table id="table-user" class="display">
                    <thead>
                        <th>No</th>
                        <th>Causer</th>
                        <th>Log Name</th>
                        <th>Description</th>
                        <th>Created Date</th>
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
            serverSide: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            order: [[4, 'desc']],
            columnDefs: [
                {
                    targets: '_all',
                    defaultContent: "N/A",
                }
            ],
            ajax: {
                url: "{{ route('be.activity.json') }}",
                method: 'get'
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                },
                {
                    data: 'causer',
                    name: 'causer',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'log_name',
                    name: 'log_name',
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                }
            ]
        });
    })
</script>
@endpush