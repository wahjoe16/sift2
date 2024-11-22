<div class="modal modal-lg modal-dialog-scrollable fade" id="pendidikan-form" tabindex="-1" aria-labelledby="pendidikan-form" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post">
        @csrf
        @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="pendidikan-title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="jenjang" class="form-label">Jenjang</label>
                            <select name="jenjang" id="jenjang" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ([
                                "D3"=>"Diploma",
                                "S1"=>"Sarjana",
                                "S2"=>"Magister",
                                "S3"=>"Doktor",
                                "Profesi" => "Profesi"
                                ] as $jenjang => $jenjangLabel)
                                <option value="{{ $jenjang }}">{{ $jenjangLabel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="npm" class="form-label">NPM (Tidak Wajib)</label>
                            <input type="text" name="npm" class="form-control" id="npm" placeholder="Nomor Pokok / Induk Mahasiswa">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <input type="number" name="angkatan" class="form-control" id="angkatan" placeholder="1234*">
                        </div>
                        <div class="col-lg-6">
                            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                            <input type="number" name="tahun_lulus" class="form-control" id="tahun_lulus" placeholder="1234*">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="perguruan_tinggi" class="form-label">Perguruan Tinggi</label>
                            <input type="text" name="perguruan_tinggi" class="form-control" id="perguruan_tinggi" placeholder="Misal: Universitas Islam Bandung">
                        </div>
                        <div class="col-lg-6">
                            <label for="program_studi" class="form-label">Program Studi</label>
                            <input type="text" name="program_studi" class="form-control" id="program_studi" placeholder="Misal: Teknik Pertambangan">
                            
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