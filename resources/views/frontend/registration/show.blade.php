@extends('frontend.layouts.app')
@section('content')

@push('styles')
    <link href="{{ asset('assets/library/smart-wizard/dist/css/smart_wizard_all.css') }}" rel="stylesheet" type="text/css" />
@endpush
<div class="row">
    <div class="col-sm-12 d-flex mb-4">
        <a href="/" class="btn btn-light mr-4" title="Kembali"><i class="fas fa-arrow-left"></i></a>
        <h4>Data Siswa</h4>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header bg-whitesmoke">
                <div class="col-sm-12 d-flex justify-content-between">
                    <div>
                        <h4>Jalur {{ $student->type == 1 ? 'Zonasi' : 'Prestasi' }}</h4>
                        <h4>Nomor Registrasi : {{ $student->registration_number }} (Harap simpan nomor registrasi untuk mengecek kembali status registrasi siswa)</h4>
                    </div>
                    <h4>
                        @switch($student->status)
                            @case(1)
                                <span class="badge badge-success">Lolos</span>
                                @break

                            @case(2)
                                <span class="badge badge-danger">Tidak Lolos</span>
                                @break

                            @default
                                <span class="badge badge-warning">Ditinjau</span>
                        @endswitch
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-12 col-lg-12 table-responsive">
                        <h6 class="section-title" style="margin-top: 0;">Keterangan Pribadi</h6>
                        <table class="table table-md table-striped">
                            <tr>
                                <td width="20%" rowspan="6">
                                    <img src="{{ asset('storage/documents/'.$student->id.'/'.$student->document->student_image) }}" width="100%">
                                </td>
                                <td width="20%">Nama Lengkap</td>
                                <td width="25%">: {{ $student->fullname }}</td>
                                <td width="20%">Kewarganegaraan</td>
                                <td>: {{ $student->citizenship }}</td>
                            </tr>
                            <tr>
                                <td>Nama Panggilan</td>
                                <td>: {{ $student->nickname }}</td>
                                <td>Anak Keberapa</td>
                                <td>: {{ $student->birth_order }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>: {{ $student->gender == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>Jumlah Saudara Kandung</td>
                                <td>: {{ $student->total_sibling }}</td>
                            </tr>
                            <tr>
                                <td>Tempat, Tanggal Lahir</td>
                                <td>: {{ $student->pob }}, {{ $student->dob->format('d-m-Y') }}</td>
                                <td>Jumlah Saudara Tiri</td>
                                <td>: {{ $student->total_step_sibling }}</td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>: {{ $student->religion }}</td>
                                <td>Jumlah Saudara Angkat</td>
                                <td>: {{ $student->total_foster_sibling }}</td>
                            </tr>
                            <tr>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-12 table-responsive">
                        <table class="table table-md table-striped">
                            <tr>
                                <td width="20%">Golongan Darah</td>
                                <td width="30%">: {{ $student->blood_type }}</td>
                                <td width="20%">Jarak Tempat Tinggal ke Sekolah</td>
                                <td width="25%">: {{ $student->distance_in_meters }} meter</td>
                            </tr>
                            <tr>
                                <td>Bahasa Sehari-hari</td>
                                <td>: {{ $student->language }}</td>
                                <td>Jarak Tempuh ke Sekolah</td>
                                <td>: {{ $student->distance_in_minutes }} menit</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: {{ $student->address }}</td>
                                <td>Ke Sekolah Dengan</td>
                                <td>: 
                                    @switch($student->transportation)
                                        @case(1)
                                            <span>Kendaraan Umum</span>
                                            @break

                                        @case(2)
                                            <span>Kendaraan Pribadi</span>
                                            @break

                                        @case(3)
                                            <span>Jalan Kaki</span>
                                            @break
                                    @endswitch
                                </td>
                            </tr>
                            <tr>
                                <td>No. Telepon (HP)</td>
                                <td>: +62{{ $student->phone }}</td>
                                <td>Berat Badan / Tinggi Badan</td>
                                <td>: {{ !$student->weight_in_kg ? '-' : $student->weight_in_kg }} kg / {{ !$student->height_in_cm ? '-' : $student->height_in_cm }} cm</td>
                            </tr>
                            <tr>
                                <td>Bertempat Tinggal</td>
                                <td>: 
                                    @switch($student->residence)
                                        @case(1)
                                            <span>Orang Tua</span>
                                            @break

                                        @case(2)
                                            <span>Menumpang pada orang lain</span>
                                            @break

                                        @case(3)
                                            <span>Asrama</span>
                                            @break

                                        @default
                                            <span></span>
                                    @endswitch
                                </td>
                                <td>Riwayat Penyakit</td>
                                <td>: {{ str_replace(',', ', ', $student->disease_history) }}</td>
                            </tr>
                        </table>
                        <h6 class="section-title">Pendidikan Sebelumnya</h6>
                        <table class="table table-md table-striped">
                            <tr>
                                <td width="15%">Nama TK</td>
                                <td>: {{ $student->kindergarten_name }}</td>
                                <td width="20%">Tanggal dan Nomor Ijazah</td>
                                <td>: {{ $student->certificate_number }}</td>
                            </tr>
                            <tr>
                                <td>Alamat TK</td>
                                <td>: {{ $student->kindergarten_address }}</td>
                                <td>Lama Belajar</td>
                                <td>: {{ $student->long_study }}</td>
                            </tr>
                        </table>
                        <h6 class="section-title">Data Orang Tua</h6>
                        <table class="table table-md table-striped">
                            @php
                            $ayah = $student->parents->where('type', 1)->first();
                            $ibu  = $student->parents->where('type', 2)->first();
                            $wali = $student->parents->where('type', 3)->first();
                            @endphp
                            <tr>
                                <td colspan="2"><h6 class="text-primary">Data Ayah</h6></td>
                                <td colspan="2"><h6 class="text-primary">Data Ibu</h6></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>: {{ $ayah->name }}</td>
                                <td>Nama</td>
                                <td>: {{ $ibu->name }}</td>
                            </tr>
                            <tr>
                                <td>Tempat, Tanggal Lahir</td>
                                <td>: {{ $ayah->pob.', '.$ayah->dob->format('d-m-Y') }}</td>
                                <td>Tempat, Tanggal Lahir</td>
                                <td>: {{ $ibu->pob.', '.$ibu->dob->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>: {{ $ayah->religion }}</td>
                                <td>Agama</td>
                                <td>: {{ $ibu->religion }}</td>
                            </tr>
                            <tr>
                                <td>Ijazah Tertinggi</td>
                                <td>: {{ $ayah->last_education }}</td>
                                <td>Ijazah Tertinggi</td>
                                <td>: {{ $ibu->last_education }}</td>
                            </tr>
                            <tr>
                                <td>Pekerjaan</td>
                                <td>: {{ $ayah->job }}</td>
                                <td>Pekerjaan</td>
                                <td>: {{ $ibu->job }}</td>
                            </tr>
                            <tr>
                                <td>Penghasilan per Bulan</td>
                                <td>: Rp{{ number_format($ayah->monthly_income, 0, ',', '.') }}</td>
                                <td>Penghasilan per Bulan</td>
                                <td>: Rp{{ number_format($ibu->monthly_income, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Kewarganegaraan</td>
                                <td>: {{ $ayah->citizenship }}</td>
                                <td>Kewarganegaraan</td>
                                <td>: {{ $ibu->citizenship }}</td>
                            </tr>
                            <tr>
                                <td>No. Telepon (HP)</td>
                                <td>: +62{{ $ayah->phone }}</td>
                                <td>No. Telepon (HP)</td>
                                <td>: +62{{ $ibu->phone }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: {{ $ayah->address }}</td>
                                <td>Alamat</td>
                                <td>: {{ $ibu->address }}</td>
                            </tr>
                            <tr>
                                <td>Masih Hidup</td>
                                <td>: {{ $ayah->is_alive == 2 ? 'Tidak' : 'Ya' }}</td>
                                <td>Masih Hidup</td>
                                <td>: {{ $ibu->is_alive == 2 ? 'Tidak' : 'Ya' }}</td>
                            </tr>
                        </table>
                        @if($wali)
                        <h6 class="section-title">Data Wali</h6>
                        <table class="table table-md table-striped">
                            <tr>
                                <td>Nama</td>
                                <td>: {{ $wali->name }}</td>
                                <td>Ijazah Tertinggi</td>
                                <td>: {{ $wali->last_education }}</td>
                            </tr>
                            <tr>
                                <td>Tempat, Tanggal Lahir</td>
                                <td>: {{ $wali->pob.', '.$wali->dob->format('d-m-Y') }}</td>
                                <td>Pekerjaan</td>
                                <td>: {{ $wali->job }}</td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>: {{ $wali->religion }}</td>
                                <td>Penghasilan per Bulan</td>
                                <td>: Rp{{ number_format($wali->monthly_income, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Kewarganegaraan</td>
                                <td>: {{ $wali->citizenship }}</td>
                                <td>No. Telepon (HP)</td>
                                <td>: +62{{ $wali->phone }}</td>
                            </tr>
                            <tr>
                                <td>Hubungan Keluarga</td>
                                <td>: {{ $wali->relationship }}</td>
                                <td>Alamat</td>
                                <td>: {{ $wali->address }}</td>
                            </tr>
                        </table>
                        @endif
                        <h6 class="section-title">Dokumen</h6>
                        <table class="table table-md table-striped">
                            <tr>
                                <td>Akta Kelahiran</td>
                                <td>
                                    @if($student->document->birth_certificate)
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-pdf" data-title="Akta Kelahiran" data-file="{{ asset('storage/documents/'.$student->id.'/'.$student->document->birth_certificate) }}" data-type="{{ explode('.', $student->document->birth_certificate)[1] }}">Lihat Dokumen</button>
                                    @else
                                    <button class="btn btn-secondary btn-sm" disabled>Tidak Ada Dokumen</button>
                                    @endif
                                </td>
                                <td>Kartu Indonesia Pintar (KIP)</td>
                                <td>
                                    @if($student->document->kip)
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-pdf" data-title="Kartu Indonesia Pintar" data-file="{{ asset('storage/documents/'.$student->id.'/'.$student->document->kip) }}" data-type="{{ explode('.', $student->document->kip)[1] }}">Lihat Dokumen</button>
                                    @else
                                    <button class="btn btn-secondary btn-sm" disabled>Tidak Ada Dokumen</button>
                                    @endif
                                </td>
                                <td>KTP Ayah</td>
                                <td>
                                    @if($student->document->father_id)
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-pdf" data-title="KTP Ayah" data-file="{{ asset('storage/documents/'.$student->id.'/'.$student->document->father_id) }}" data-type="{{ explode('.', $student->document->father_id)[1] }}">Lihat Dokumen</button>
                                    @else
                                    <button class="btn btn-secondary btn-sm" disabled>Tidak Ada Dokumen</button>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Kartu Keluarga</td>
                                <td>
                                    @if($student->document->family_certificate)
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-pdf" data-title="Kartu Keluarga" data-file="{{ asset('storage/documents/'.$student->id.'/'.$student->document->family_certificate) }}" data-type="{{ explode('.', $student->document->family_certificate)[1] }}">Lihat Dokumen</button>
                                    @else
                                    <button class="btn btn-secondary btn-sm" disabled>Tidak Ada Dokumen</button>
                                    @endif
                                </td>
                                <td>Kartu Perlindungan Sosial (KPS)</td>
                                <td>
                                    @if($student->document->kps)
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-pdf" data-title="Kartu Perlindungan Sosial" data-file="{{ asset('storage/documents/'.$student->id.'/'.$student->document->kps) }}" data-type="{{ explode('.', $student->document->kps)[1] }}">Lihat Dokumen</button>
                                    @else
                                    <button class="btn btn-secondary btn-sm" disabled>Tidak Ada Dokumen</button>
                                    @endif
                                </td>
                                <td>KTP Ibu</td>
                                <td>
                                    @if($student->document->mother_id)
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-pdf" data-title="KTP Ibu" data-file="{{ asset('storage/documents/'.$student->id.'/'.$student->document->mother_id) }}" data-type="{{ explode('.', $student->document->mother_id)[1] }}">Lihat Dokumen</button>
                                    @else
                                    <button class="btn btn-secondary btn-sm" disabled>Tidak Ada Dokumen</button>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Ijazah TK/PAUD</td>
                                <td>
                                    @if($student->document->kindergarten_certificate)
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-pdf" data-title="Ijazah TK/PAUD" data-file="{{ asset('storage/documents/'.$student->id.'/'.$student->document->kindergarten_certificate) }}" data-type="{{ explode('.', $student->document->kindergarten_certificate)[1] }}">Lihat Dokumen</button>
                                    @else
                                    <button class="btn btn-secondary btn-sm" disabled>Tidak Ada Dokumen</button>
                                    @endif
                                </td>
                                <td>BPJS</td>
                                <td>
                                    @if($student->document->bpjs)
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-pdf" data-title="BPJS" data-file="{{ asset('storage/documents/'.$student->id.'/'.$student->document->bpjs) }}" data-type="{{ explode('.', $student->document->bpjs)[1] }}">Lihat Dokumen</button>
                                    @else
                                    <button class="btn btn-secondary btn-sm" disabled>Tidak Ada Dokumen</button>
                                    @endif
                                </td>
                                <td>Kartu Identitas Anak (KIA)</td>
                                <td>
                                    @if($student->document->kia)
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-pdf" data-title="Kartu Identitas Anak (KIA)" data-file="{{ asset('storage/documents/'.$student->id.'/'.$student->document->kia) }}" data-type="{{ explode('.', $student->document->kia)[1] }}">Lihat Dokumen</button>
                                    @else
                                    <button class="btn btn-secondary btn-sm" disabled>Tidak Ada Dokumen</button>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        @if($student->otherDocuments)
                        <h6 class="section-title">Sertifikat Prestasi</h6>
                        <table class="table table-md table-striped">
                            <tr>
                                <td>Nama Sertifikat</td>
                                <td>Dokumen Sertifikat</td>
                            </tr>
                            @foreach($student->otherDocuments as $doc)
                            <tr>
                                <td>{{ $doc->name ?? '-' }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-pdf" data-title="{{ $doc->name }}" data-file="{{ asset('storage/documents/'.$student->id.'/'.$doc->file) }}" data-type="{{ explode('.', $doc->file)[1] }}">Lihat Dokumen</button>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<div class="modal fade" id="modal-pdf" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0;"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#modal-pdf').on("show.bs.modal", (e) => {
            var file = $(e.relatedTarget).data('file')
            if ($(e.relatedTarget).data('type') == 'pdf') {
                $('.modal-body').html('<iframe class="file" src="'+file+'" width="100%" style="min-height: calc(100vh - 140px);"></iframe>')
            } else {
                $('.modal-body').html('<img class="file" src="'+file+'" width="100%"></img>')
            }
            $('.modal-title').text($(e.relatedTarget).data('title'))
        })
    })
</script>
@endpush
@endsection
