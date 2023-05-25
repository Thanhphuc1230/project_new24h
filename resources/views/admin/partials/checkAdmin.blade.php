<div class="modal fade" id="exampleModalCenterCheck" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Xác nhận mật khẩu</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="{{ route('admin.checkSessionAndLogout') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="container-fluid p-0 sm_padding_15px">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">
                            <div class="white_card_body">
                                <form>
                                    <div class="mb-3">
                                        <h6 class="card-subtitle mb-2">Tài khoản
                                            {{ Auth::user()->fullname }}</h6>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="card-subtitle mb-2">Mật khẩu</h6>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Gửi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
</div>
