<div class="modal modal-lg modal-dialog-scrollable fade" id="keahlian-form" tabindex="-1" aria-labelledby="keahlian-form" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post">
        @csrf
        @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="keahlian-title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="mb-3">
                            <label for="keahlian" class="form-label">Keahlian</label>
                            <input type="text" name="keahlian[]" class="form-control" placeholder="Misal: Desain Grafis">
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