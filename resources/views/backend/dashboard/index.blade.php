@extends('backend.layouts.app')
@section('content')
<div class="col-12 mb-4">
    <div class="hero bg-light text-primary">
        <div class="hero-inner">
            <h2>Selamat Datang {{ auth()->user()->name }} </h2>
            <p class="lead">Semoga Hari Anda Selalu Menyenangkan.</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="fas fa-user-gear"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Operator</h4>
                    </div>
                    <div class="card-body">
                        {{$operator}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-file-lines"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pendaftar</h4>
                    </div>
                    <div class="card-body">
                        {{$zonasi + $prestasi}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-map-location-dot"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pendaftar (Zonasi)</h4>
                    </div>
                    <div class="card-body">
                        {{$zonasi}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pendaftar (Prestasi)</h4>
                    </div>
                    <div class="card-body">
                        {{$prestasi}}
                    </div>
                </div>
            </div>
        </div>                  
    </div>
</div>
@endsection