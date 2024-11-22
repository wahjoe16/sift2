<div class="modal modal-lg modal-dialog-scrollable fade" id="kompetensi-form" tabindex="-1" aria-labelledby="kompetensi-form" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="kompetensi-title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-md-7">
                            <label for="kompetensi" class="form-label">Kompetensi</label>
                            <input type="text" class="form-control" id="kompetensi" name="kompetensi" placeholder="Misal: MS. Office Specialist 2019">
                            {{-- <input type="text" class="form-control" id="kompetensi" name="kompetensi[]"> --}}
                        </div>

                        <div class="col-md-5">
                            <label for="sertifikat" class="form-label">Sertifikat Kompetensi</label>
                            <input class="form-control" type="file" id="sertifikat" name="sertifikat">
                            {{-- <input class="form-control" type="file" id="sertifikat" name="sertifikat[]"> --}}
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