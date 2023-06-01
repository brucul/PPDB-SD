<form id="form-1" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate autocomplete="off">
    <div class="col-sm-12">
        <h4 class="text-primary" align="center">Keterangan Pribadi</h4>
        <hr>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="form-group">
            <label for="form1-fullname" class="form-label">Nama Lengkap Siswa<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="form1-fullname" name="fullname" placeholder="Masukkan Nama Lengkap Siswa" required>
            <div class="" id="form1-message-fullname"></div>
        </div>
        <div class="form-group">
            <label for="form1-nickname" class="form-label">Nama Panggilan Siswa<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="form1-nickname" name="nickname" placeholder="Masukkan Nama Panggilan Siswa" required>
            <div class="" id="form1-message-nickname"></div>
        </div>
        <div class="form-group">
            <label for="form1-gender" class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
            <div class="selectgroup w-100">
                <label class="selectgroup-item">
                    <input type="radio" name="gender" value="1" class="selectgroup-input" checked>
                    <span class="selectgroup-button"><i class="fas fa-child"></i> Laki-laki</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="gender" value="2" class="selectgroup-input">
                    <span class="selectgroup-button"><i class="fas fa-child-dress"></i> Perempuan</span>
                </label>
            </div>
            <div class="" id="form1-message-gender"></div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6 col-sm-12">
                <label for="form1-pob" class="form-label">Tempat Lahir<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="form1-pob" name="pob" placeholder="Masukkan Tempat Lahir" required>
                <div class="" id="form1-message-pob"></div>
            </div>
            <div class="form-group col-lg-6 col-sm-12">
                <label for="form1-dob" class="form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                <input type="text" class="form-control dob" id="form1-dob" name="dob" placeholder="Masukkan Tanggal Lahir" required>
                <div class="" id="form1-message-dob"></div>
            </div>
        </div>
        <div class="form-group">
            <label for="form1-religion" class="form-label">Agama<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="form1-religion" name="religion" placeholder="Masukkan Agama" required>
            <div class="" id="form1-message-religion"></div>
        </div>
        <div class="form-group">
            <label for="form1-citizenship" class="form-label">Kewarganegaraan<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="form1-citizenship" name="citizenship" placeholder="Masukkan Kewarganegaraan" required>
            <div class="" id="form1-message-citizenship"></div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6 col-sm-12">
                <label for="form1-birth_order" class="form-label">Anak Keberapa<span class="text-danger">*</span></label>
                <input type="text" class="form-control input-number" id="form1-birth_order" name="birth_order" placeholder="Masukkan Anak Keberapa" required>
                <div class="" id="form1-message-birth_order"></div>
            </div>
            <div class="form-group col-lg-6 col-sm-12">
                <label for="form1-total_sibling" class="form-label">Jumlah Saudara Kandung</label>
                <input type="text" class="form-control input-number" id="form1-total_sibling" name="total_sibling" placeholder="Masukkan Jumlah Saudara Kandung">
                <div class="" id="form1-message-total_sibling"></div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6 col-sm-12">
                <label for="form1-total_step_sibling" class="form-label">Jumlah Saudara Tiri</label>
                <input type="text" class="form-control input-number" id="form1-total_step_sibling" name="total_step_sibling" placeholder="Masukkan Jumlah Saudara Tiri">
                <div class="" id="form1-message-total_step_sibling"></div>
            </div>
            <div class="form-group col-lg-6 col-sm-12">
                <label for="form1-total_foster_sibling" class="form-label">Jumlah Saudara Angkat</label>
                <input type="text" class="form-control input-number" id="form1-total_foster_sibling" name="total_foster_sibling" placeholder="Masukkan Jumlah Saudara Angkat">
                <div class="" id="form1-message-total_foster_sibling"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="row">
            <div class="form-group col-lg-6 col-sm-12">
                <label for="form1-blood_type" class="form-label">Golongan Darah</label>
                <input type="text" class="form-control" id="form1-blood_type" name="blood_type" placeholder="Masukkan Golongan Darah">
                <div class="" id="form1-message-blood_type"></div>
            </div>
            <div class="form-group col-lg-6 col-sm-12">
                <label for="form1-language" class="form-label">Bahasa Sehari-hari<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="form1-language" name="language" placeholder="Masukkan Bahasa Sehari-hari" required>
                <div class="" id="form1-message-language"></div>
            </div>
        </div>
        <div class="form-group">
            <label for="form1-address" class="form-label">Alamat<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="form1-address" name="address" placeholder="Masukkan Alamat" required>
            <div class="" id="form1-message-address"></div>
        </div>
        <div class="form-group">
            <label for="form1-phone" class="form-label">No. Telepon (HP)<span class="text-danger">*</span></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        +62
                    </div>
                </div>
                <input type="text" class="form-control" id="form1-phone" name="phone" placeholder="857xxxxxxx" required>
                <div class="" id="form1-message-phone"></div>
            </div>
        </div>
        <div class="form-group">
            <label for="form1-residence" class="form-label">Bertempat Tinggal<span class="text-danger">*</span></label>
            <div class="selectgroup w-100">
                <label class="selectgroup-item">
                    <input type="radio" name="residence" value="1" class="selectgroup-input" checked>
                    <span class="selectgroup-button">Orang tua</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="residence" value="2" class="selectgroup-input">
                    <span class="selectgroup-button">Menumpang pada orang lain</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="residence" value="3" class="selectgroup-input">
                    <span class="selectgroup-button">Asrama</span>
                </label>
            </div>
            <div class="" id="form1-message-residence"></div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6 col-sm-12">
                <label for="form1-distance_in_meters" class="form-label">Jarak Tempat Tinggal ke Sekolah<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control input-number" id="form1-distance_in_meters" name="distance_in_meters" placeholder="Masukkan Jarak Tempat Tinggal" required>
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            Meter
                        </div>
                    </div>
                    <div class="" id="form1-message-distance_in_meters"></div>
                </div>
            </div>
            <div class="form-group col-lg-6 col-sm-12">
                <label for="form1-distance_in_minutes" class="form-label">Waktu Tempuh ke Sekolah<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control input-number" id="form1-distance_in_minutes" name="distance_in_minutes" placeholder="Masukkan Waktu Tempuh" required>
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            Menit
                        </div>
                    </div>
                    <div class="" id="form1-message-distance_in_minutes"></div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="form1-transportation" class="form-label">Ke Sekolah Dengan<span class="text-danger">*</span></label>
            <div class="selectgroup w-100">
                <label class="selectgroup-item">
                    <input type="radio" name="transportation" value="1" class="selectgroup-input" checked>
                    <span class="selectgroup-button">Kendaraan Umum</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="transportation" value="2" class="selectgroup-input">
                    <span class="selectgroup-button">Kendaraan Pribadi</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="transportation" value="3" class="selectgroup-input">
                    <span class="selectgroup-button">Jalan Kaki</span>
                </label>
            </div>
            <div class="" id="form1-message-transportation"></div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6 col-sm-12">
                <label for="form1-weight_in_kg" class="form-label">Berat Badan</label>
                <div class="input-group">
                    <input type="text" class="form-control input-number" id="form1-weight_in_kg" name="weight_in_kg" placeholder="Masukkan Berat Badan">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            kg
                        </div>
                    </div>
                    <div class="" id="form1-message-weight_in_kg"></div>
                </div>
            </div>
            <div class="form-group col-lg-6 col-sm-12">
                <label for="form1-height_in_cm" class="form-label">Tinggi Badan</label>
                <div class="input-group">
                    <input type="text" class="form-control input-number" id="form1-height_in_cm" name="height_in_cm" placeholder="Masukkan Tinggi Badan">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            cm
                        </div>
                    </div>
                    <div class="" id="form1-message-height_in_cm"></div>
                </div>
            </div>
        </div>
        <div class="form-group disease_history_field">
            <label for="disease_history_0" class="form-label">Riwayat Penyakit</label>
            <div class="input-group">
                <input type="text" class="form-control" id="disease_history_0" name="disease_history[]" placeholder="Masukkan Riwayat Penyakit">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <button type="button" class="btn btn-outline-info btn-add-disease"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <h4 class="text-primary" align="center">Keterangan Pendidikan Sebelumnya</h4>
        <hr>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
        <label for="form1-kindergarten_name" class="form-label">Nama TK</label>
        <input type="text" class="form-control" id="form1-kindergarten_name" name="kindergarten_name" placeholder="Masukkan Nama TK">
        <div class="" id="form1-message-kindergarten_name"></div>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
        <label for="form1-kindergarten_address" class="form-label">Alamat TK</label>
        <input type="text" class="form-control" id="form1-kindergarten_address" name="kindergarten_address" placeholder="Masukkan Alamat TK">
        <div class="" id="form1-message-kindergarten_address"></div>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
        <label for="form1-certificate_number" class="form-label">Tanggal dan Nomor Ijazah</label>
        <input type="text" class="form-control" id="form1-certificate_number" name="certificate_number" placeholder="Masukkan Tanggal dan Nomor Ijazah">
        <div class="" id="form1-message-certificate_number"></div>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
        <label for="form1-long_study" class="form-label">Lama Belajar</label>
        <input type="text" class="form-control input-number" id="form1-long_study" name="long_study" placeholder="Masukkan Lama Belajar">
        <div class="" id="form1-message-long_study"></div>
    </div>
</form>