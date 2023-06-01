@extends('frontend.layouts.app')
@section('content')

<div class="row">
    <div class="col-12 mb-4">
        <div class="hero text-white hero-bg-image hero-bg-parallax" style="background-image: url('assets/img/unsplash/andre-benz-1214056-unsplash.jpg');">
            <div class="hero-inner">
                <h2>Hallo!</h2>
                <p class="lead">Selamat datang di Sistem PPDB online SD Negeri 49 Kota Parepare.</p>
                <p style="font-size: 80%">Pendaftaran dibuka tanggal <b class="text-info">{{$setting->start_date->format('d F Y')}}</b> sampai <b class="text-info">{{$setting->end_date->format('d F Y')}}</b>.</p>
                <div class="mt-4">
                    <a href="{{ route('fe.instruction') }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-circle-info"></i> Lihat Petunjuk Pendaftaran</a>
                    <button class="btn btn-info btn-lg btn-icon icon-left ml-2 btn-search-student"><i class="fas fa-circle-question"></i> Sudah daftar? Lihat Status</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-6">
        <div class="card card-dark">
            <div class="card-header">
                <h4>Jalur Zonasi</h4>
                <div class="card-header-action">
                    <a href="{{ route('fe.registration.zonasi') }}" class="btn btn-primary">
                        Daftar
                    </a>
                </div>
            </div>
            <div class="card-body">
                <p>Pendaftaran jalur <b class="text-primary">zonasi</b> diperuntukkan bagi calon siswa yang memiliki domisili desa zona terdekat dengan sekolah.</p>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-6">
        <div class="card card-dark">
            <div class="card-header">
                <h4>Jalur Prestasi</h4>
                <div class="card-header-action">
                    <a href="{{ route('fe.registration.prestasi') }}" class="btn btn-primary">
                        Daftar
                    </a>
                </div>
            </div>
            <div class="card-body">
                <p>Pendaftaran jalur <b class="text-primary">prestasi</b> diperuntukan bagi para calon siswa yang memiliki prestasi dan berada di luar zonasi sekolah sepanjang memenuhi persyaratan.</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btn-search-student').on('click', function () {
            swal({
                title: 'Lihat Status Pendaftaran',
                text: 'Masukkan Nomor Pendaftaran',
                icon: 'info',
                content: "input",
                button: {
                    text: "Cari",
                    closeModal: false,
                },
            })
            .then(registration_number => {
                if (registration_number){
                    $.ajax({
                        url: "{{ route('fe.registration.search') }}",
                        method : "post",
                        cache: false,
                        data: {registration_number: registration_number},
                        success: function(response){
                            if (response.status) {
                                swal('Success', response.message, 'success')
                                setTimeout(() => {
                                    location.href = "{{ url('status-pendaftaran') }}" + '/' + response.data.registration_number
                                }, 1000);
                            } else {
                                swal('Failed', response.message, 'error')
                            }
                        },
                        error: function(xhr, AbsenceType, error) {
                            swal('Failed', xhr.responseJSON.message, 'error')
                        },
                    });
                } else {
                    swal.close();
                }
            });
        })
        
    });
</script>
@endpush

@endsection
