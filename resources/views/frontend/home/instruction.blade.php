@extends('frontend.layouts.app')
@section('content')

@push('styles')
    <link href="{{ asset('assets/library/smart-wizard/dist/css/smart_wizard_all.css') }}" rel="stylesheet" type="text/css" />
@endpush
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header bg-whitesmoke">
                <a href="javascript:history.back()" class="btn btn-light mr-4" title="Kembali"><i class="fas fa-arrow-left"></i></a>
                <h4>Petunjuk Pendaftaran</h4>
            </div>
            <div class="card-body">
                {!! getSetting()->instruction !!}
            </div>
        </div>
    </div>
</div>

@push('scripts')

@endpush
@endsection
