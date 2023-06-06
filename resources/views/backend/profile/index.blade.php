@extends('backend.layouts.app')
@section('content')
<div class="col-12 mb-4">
    <div class="card">
        <form action="{{ route('be.profile.update', auth()->user()->id) }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate="" id="form-profile">
            @csrf
            @method('PATCH')
            <div class="card-header">
                <h4>Update Profile</h4>
            </div>
            <div class="card-body row">
                <div class="form-group col-6">
                    <label>Nama<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required>
                    <div class="invalid-feedback">
                        What's your name?
                    </div>
                </div>
                <div class="form-group col-6">
                    <label>Username<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="username" value="{{ auth()->user()->username }}" required>
                    <div class="invalid-feedback">
                        Username is invalid.
                    </div>
                </div>
                <div class="form-group col-6">
                    <label>Image <i class="text-info" style="font-size: 80%;">*Max. 2Mb - recommended dimension: 180x180</i></label>
                    <div class="input-group">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="image" accept="image/*">
                            <label class="custom-file-label" for="image">Choose Image</label>
                        </div>
                    </div>
                    <span class="text-warning" style="font-size: 80%;"><i>*Leave blank if you don't want to change the image</i></span>
                </div>
                <div class="form-group col-6">
                    <label>Password</label>
                    <div class="input-group" id="show_hide_password">
                        <input type="password" class="form-control" name="password" id="password">
                        <div class="input-group-append">
                            <a href="javascript:;" class="input-group-text" style="text-decoration: none;"><i class="fas fa-eye-slash"></i></a>
                        </div>
                    </div>
                    <div class="invalid-feedback">
                        Password is invalid.
                    </div>
                    <span class="text-warning" style="font-size: 80%;"><i>*Leave blank if you don't want to change the password</i></span>
                </div>
                <div class="form-group col-6">
                    <img id="preview" src="{{ auth()->user()->image ? asset('storage/user/images/'.auth()->user()->image) : asset('assets/img/avatar/avatar-1.png') }}" alt="your image" width="180" height="180">
                </div>
                <div class="form-group col-6 mb-0">
                    <label>Confirm Password</label>
                    <div class="input-group" id="show_hide_password_confirm">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                        <div class="input-group-append">
                            <a href="javascript:;" class="input-group-text" style="text-decoration: none;"><i class="fas fa-eye-slash"></i></a>
                        </div>
                    </div>
                    <div class="invalid-feedback">
                        Password confirmation is invalid.
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
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

        $('#password').on('input', function () {
            var password = $(this).val()
            if (password.length >= 1) {
                $('#password_confirmation').attr('required', true)
            } else {
                $('#password_confirmation').attr('required', false)
            }
        })

        $('#image').on('change', function () {
            var reader = new FileReader();
            var input = this;

            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        })
    })
</script>
@endpush