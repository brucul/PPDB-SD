<!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <title>{{ $student->registration_number }}</title>
        <style type="text/css">
            table {
                border-collapse: collapse;
            }
            table tr {
                border-bottom: 1px solid;
                vertical-align: bottom;
            }
            table td {
                padding: 5px;
            }
            .page-break {
                page-break-before: always;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-sm-12" align="center" style="border-bottom: 5px double;">
                <h2>Formulir Pendaftaran Peserta Didik Baru</h2>
                <h4>Tahun Ajaran : {{ getSetting()->school_year }}</h4>
            </div>
            <div class="col-sm-6 col-md-12 col-lg-12" style="margin-top: 10px;">
                <h4 style="text-decoration: underline;">Nomor Pendaftaran: {{ $student->registration_number }}</h4>
                <h6 class="section-title">Keterangan Pribadi</h6>
                <table class="table">
                    <tr>
                        <td width="40%">Nama Lengkap</td>
                        <td>: {{ $student->fullname }}</td>
                    </tr>
                    <tr>
                        <td>Nama Panggilan</td>
                        <td>: {{ $student->nickname }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: {{ $student->gender == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <td>Tempat, Tanggal Lahir</td>
                        <td>: {{ $student->pob }}, {{ $student->dob->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>: {{ $student->religion }}</td>
                    </tr>
                    <tr>
                        <td>Kewarganegaraan</td>
                        <td>: {{ $student->citizenship }}</td>
                    </tr>
                    <tr>
                        <td>Anak Keberapa</td>
                        <td>: {{ $student->birth_order }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Saudara Kandung</td>
                        <td>: {{ $student->total_sibling }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Saudara Tiri</td>
                        <td>: {{ $student->total_step_sibling }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Saudara Angkat</td>
                        <td>: {{ $student->total_foster_sibling }}</td>
                    </tr>
                    <tr>
                        <td>Bahasa Sehari-hari</td>
                        <td>: {{ $student->language }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: {{ $student->address }}</td>
                    </tr>
                    <tr>
                        <td>No. Telepon (HP)</td>
                        <td>: +62{{ $student->phone }}</td>
                    </tr>
                    <tr>: 
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
                    </tr>
                    <tr>
                        <td>Jarak Tempat Tinggal ke Sekolah</td>
                        <td>: {{ $student->distance_in_meters }} meter</td>
                    </tr>
                    <tr>
                        <td>Ke Sekolah Dengan</td>
                        <td> : 
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
                        <td>Waktu Tempuh ke Sekolah</td>
                        <td>: {{ $student->distance_in_minutes }} menit</td>
                    </tr>
                    <tr>
                        <td>Berat Badan / Tinggi Badan</td>
                        <td>: {{ !$student->weight_in_kg ? '-' : $student->weight_in_kg }} kg /: {{ !$student->height_in_cm ? '-' : $student->height_in_cm }} cm</td>
                    </tr>
                    <tr>
                        <td>Golongan Darah</td>
                        <td>: {{ $student->blood_type }}</td>
                    </tr>
                    <tr>
                        <td>Riwayat Penyakit</td>
                        <td>: {{ str_replace(',', ', ', $student->disease_history) }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-12">
                <h6 class="section-title">Pendidikan Sebelumnya</h6>
                <table class="table">
                    <tr>
                        <td width="40%">Nama TK</td>
                        <td>: {{ $student->kindergarten_name }}</td>
                    </tr>
                    <tr>
                        <td>Alamat TK</td>
                        <td>: {{ $student->kindergarten_address }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal dan Nomor Ijazah</td>
                        <td>: {{ $student->certificate_number }}</td>
                    </tr>
                    <tr>
                        <td>Lama Belajar</td>
                        <td>: {{ $student->long_study }}</td>
                    </tr>
                </table>
                <div class="page-break"></div>
                <h6 class="section-title">Data Orang Tua</h6>
                <table class="table">
                    @php
                    $ayah = $student->parents->where('type', 1)->first();
                    $ibu  = $student->parents->where('type', 2)->first();
                    $wali = $student->parents->where('type', 3)->first();
                    @endphp
                    <tr>
                        <td colspan="2"><h6 class="text-primary">Data Ayah</h6></td>
                    </tr>
                    <tr>
                        <td width="40%">Nama</td>
                        <td>: {{ $ayah->name }}</td>
                    </tr>
                    <tr>
                        <td>Tempat, Tanggal Lahir</td>
                        <td>: {{ $ayah->pob.', '.$ayah->dob->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>: {{ $ayah->religion }}</td>
                    </tr>
                    <tr>
                        <td>Ijazah Tertinggi</td>
                        <td>: {{ $ayah->last_education }}</td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td>: {{ $ayah->job }}</td>
                    </tr>
                    <tr>
                        <td>Penghasilan per Bulan</td>
                        <td>: Rp{{ number_format($ayah->monthly_income, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Kewarganegaraan</td>
                        <td>: {{ $ayah->citizenship }}</td>
                    </tr>
                    <tr>
                        <td>No. Telepon (HP)</td>
                        <td>: +62{{ $ayah->phone }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: {{ $ayah->address }}</td>
                    </tr>
                    <tr>
                        <td>Masih Hidup</td>
                        <td>: {{ $ayah->is_alive == 2 ? 'Tidak' : 'Ya' }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><h6 class="text-primary">Data Ibu</h6></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $ibu->name }}</td>
                    </tr>

                    <tr>
                        <td>Tempat, Tanggal Lahir</td>
                        <td>: {{ $ibu->pob.', '.$ibu->dob->format('d-m-Y') }}</td>
                    </tr>

                    <tr>
                        <td>Agama</td>
                        <td>: {{ $ibu->religion }}</td>
                    </tr>

                    <tr>
                        <td>Ijazah Tertinggi</td>
                        <td>: {{ $ibu->last_education }}</td>
                    </tr>

                    <tr>
                        <td>Pekerjaan</td>
                        <td>: {{ $ibu->job }}</td>
                    </tr>

                    <tr>
                        <td>Penghasilan per Bulan</td>
                        <td>: Rp{{ number_format($ibu->monthly_income, 0, ',', '.') }}</td>
                    </tr>

                    <tr>
                        <td>Kewarganegaraan</td>
                        <td>: {{ $ibu->citizenship }}</td>
                    </tr>

                    <tr>
                        <td>No. Telepon (HP)</td>
                        <td>: +62{{ $ibu->phone }}</td>
                    </tr>

                    <tr>
                        <td>Alamat</td>
                        <td>: {{ $ibu->address }}</td>
                    </tr>

                    <tr>
                        <td>Masih Hidup</td>
                        <td>: {{ $ibu->is_alive == 2 ? 'Tidak' : 'Ya' }}</td>
                    </tr>
                </table>
                @if($wali)
                <div class="page-break"></div>
                <h6 class="section-title">Data Wali</h6>
                <table class="table">
                    <tr>
                        <td width="40%">Nama</td>
                        <td>: {{ $wali->name }}</td>
                    </tr>
                    <tr>
                        <td>Tempat, Tanggal Lahir</td>
                        <td>: {{ $wali->pob.', '.$wali->dob->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>: {{ $wali->religion }}</td>
                    </tr>
                    <tr>
                        <td>Kewarganegaraan</td>
                        <td>: {{ $wali->citizenship }}</td>
                    </tr>
                    <tr>
                        <td>Hubungan Keluarga</td>
                        <td>: {{ $wali->relationship }}</td>
                    </tr>
                    <tr>
                        <td>Ijazah Tertinggi</td>
                        <td>: {{ $wali->last_education }}</td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td>: {{ $wali->job }}</td>
                    </tr>
                    <tr>
                        <td>Penghasilan per Bulan</td>
                        <td>: Rp{{ number_format($wali->monthly_income, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: {{ $wali->address }}</td>
                    </tr>
                    <tr>
                        <td>No. Telepon (HP)</td>
                        <td>: +62{{ $wali->phone }}</td>
                    </tr>
                </table>
                @endif
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>