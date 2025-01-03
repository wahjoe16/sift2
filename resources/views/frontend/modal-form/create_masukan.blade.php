<div class="modal modal-lg modal-dialog-scrollable fade" id="masukan-form" tabindex="-1" aria-labelledby="masukan-form" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post">
        @csrf
        @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="masukan-title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label for="masukan_fakultas" class="form-label">Saran & Masukan Untuk Fakultas</label>
                            <textarea class="form-control" name="masukan_fakultas" id="" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label for="masukan_aplikasi" class="form-label">Saran & Masukan Untuk Aplikasi</label>
                            <textarea class="form-control" name="masukan_aplikasi" id="" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>