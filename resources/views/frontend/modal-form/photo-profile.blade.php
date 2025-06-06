<div class="modal fade" id="photo-form" tabindex="-1" aria-labelledby="photo-form" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 photo-profile-title"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                        <input id="upload1" type="file" name="foto" onchange="readURL1(this);" class="form-control border-0">
                        <div class="input-group-append">
                            <label for="upload1" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                        </div>
                    </div>

                    {{-- <p class="font-italic text-white text-center">The image uploaded will be rendered inside the box below.</p> --}}
                    <div class="image-area mt-4"><img id="imageResult1" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>

        </form>
    </div>
</div>