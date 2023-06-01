{{-- Modal Create Operator  --}}
<div class="modal fade" id="createOperator" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Tambah Operator</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formOperatorAdd" enctype="multipart/form-data" class="needs-validation" novalidate="">
                <div class="modal-body row">
                    <div class="form-group col-6">
                        <label for="name" class="form-label">Nama Operator<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Masukan Nama Operator" id="name" autocomplete="off" required>
                        <div class="" id="message-name"></div>
                    </div>

                    <div class="form-group col-6">
                        <label for="username" class="form-label">Username Operator<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" placeholder="Masukan Username Operator" id="username" autocomplete="off" required>
                        <div class="" id="message-username"></div>
                    </div>

                    <div class="form-group col-6">
                        <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                        <div class="input-group" id="show_hide_password">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password Operator" required>
                            <div class="input-group-append">
                                <a href="javascript:;" class="input-group-text" style="text-decoration: none;"><i class="fas fa-eye-slash"></i></a>
                            </div>
                            <div class="" id="message-password"></div>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="password_confirmation" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                        <div class="input-group" id="show_hide_password_confirm">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Masukan Ulang Password Operator" required>
                            <div class="input-group-append">
                                <a href="javascript:;" class="input-group-text" style="text-decoration: none;"><i class="fas fa-eye-slash"></i></a>
                            </div>
                            <div class="" id="message-password_confirmation"></div>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="image">Image</label>
                        <div class="input-group">
                            <!-- <div class="custom-file"> -->
                                <input type="file" class="custom-file-input mb-2" name="image" id="image" accept="image/*">
                                <label class="custom-file-label" for="image" id="image-label">Choose Image</label>
                            <!-- </div> -->
                            <div class="" id="message-image"></div>
                            <i class="text-warning" style="font-size: 80%;">*Max. 2Mb - recommended dimension: 180x180</i>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="">Image Preview</label><br>
                        <img id="preview" src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="your image" width="80" height="80">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Operator  --}}
<div class="modal fade" id="editOperator" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="title">Edit Operator</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formOperatorEdit" enctype="multipart/form-data" class="needs-validation" novalidate="">
                <input type="hidden" name="id" id="id">
                <div class="modal-body row">
                    <div class="form-group col-6">
                        <label for="edit-name" class="form-label">Nama Operator<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Masukan Nama Operator" id="edit-name" autocomplete="off" required>
                        <div class="" id="edit-message-name"></div>
                    </div>

                    <div class="form-group col-6">
                        <label for="edit-username" class="form-label">Username Operator<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" placeholder="Masukan Username Operator" id="edit-username" autocomplete="off" required>
                        <div class="" id="edit-message-username"></div>
                    </div>

                    <div class="form-group col-6">
                        <label for="edit-password" class="form-label">Password<span class="text-danger">*</span></label>
                        <div class="input-group" id="show_hide_password">
                            <input type="password" class="form-control" name="password" id="edit-password" placeholder="Masukan Password Operator">
                            <div class="input-group-append">
                                <a href="javascript:;" class="input-group-text" style="text-decoration: none;"><i class="fas fa-eye-slash"></i></a>
                            </div>
                            <div class="" id="edit-message-password"></div>
                        </div>
                        <i class="text-warning mt-1" style="font-size: 80%;">*Leave blank if you don't want to change the password</i>
                    </div>

                    <div class="form-group col-6">
                        <label for="edit-password_confirmation" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                        <div class="input-group" id="show_hide_password_confirm">
                            <input type="password" class="form-control" name="password_confirmation" id="edit-password_confirmation" placeholder="Masukan Ulang Password Operator">
                            <div class="input-group-append">
                                <a href="javascript:;" class="input-group-text" style="text-decoration: none;"><i class="fas fa-eye-slash"></i></a>
                            </div>
                            <div class="" id="edit-message-password_confirmation"></div>
                        </div>
                        <i class="text-warning mt-1" style="font-size: 80%;">*Leave blank if you don't want to change the password</i>
                    </div>

                    <div class="form-group col-6">
                        <label for="edit-image">Image</label>
                        <div class="input-group">
                            <!-- <div class="custom-file"> -->
                                <input type="file" class="custom-file-input mb-2" name="image" id="edit-image" accept="image/*">
                                <label class="custom-file-label" for="image" id="image-label-edit">Choose Image</label>
                            <!-- </div> -->
                            <div class="" id="edit-message-image"></div>
                            <i class="text-warning" style="font-size: 80%;">*Max. 2Mb - recommended dimension: 180x180</i>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="">Image Preview</label><br>
                        <img id="edit-preview" src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="your image" width="80" height="80">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>