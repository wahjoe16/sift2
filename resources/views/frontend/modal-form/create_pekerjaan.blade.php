<div class="modal modal-lg modal-dialog-scrollable fade" id="pekerjaan-form" tabindex="-1" aria-labelledby="pekerjaan-form" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post">
        @csrf
        @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="pekerjaan-title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="tahun_masuk_bekerja" class="form-label">Tahun Awal</label>
                            <input type="number" class="form-control" id="tahun_masuk_bekerja" name="tahun_masuk_bekerja">
                        </div>
                        <div class="col-md-6">
                            <label for="tahun_berhenti_bekerja" class="form-label">Tahun Berakhir / Sekarang</label>
                            <input type="number" class="form-control" id="tahun_berhenti_bekerja" name="tahun_berhenti_bekerja">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="profesi_id" class="form-label">Profesi</label>
                            <select name="profesi_id" id="profesi_id" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ($profesi as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_profesi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="jabatan_id" class="form-label">Jabatan (Fungsional)</label>
                            <select name="jabatan_id" id="jabatan_id" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ($jabatan as $j)
                                <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="col-md-6">
                            <label for="jenis_pekerjaan" class="form-label">Profesi</label>
                            <select name="jenis_pekerjaan[]" id="jenis_pekerjaan" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ([
                                "ASN/BUMN"=>"ASN/BUMN",
                                "TNI"=>"TNI",
                                "POLRI"=>"POLRI",
                                "Swasta"=>"Swasta",
                                "Berwirausaha"=>"Berwirausaha",
                                "Tidak Bekerja"=>"Tidak Bekerja",
                                ] as $jenis_pekerjaan => $jenis_pekerjaanLabel)
                                <option value="{{ $jenis_pekerjaan }}">{{ $jenis_pekerjaanLabel }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="bidang_pekerjaan" class="form-label">Bidang Pekerjaan</label>
                            <select name="bidang_pekerjaan" id="bidang_pekerjaan" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ([
                                "Pemerintahan"=>"Pemerintahan",
                                "Pendidikan"=>"Pendidikan",
                                "Industri / Manufaktur"=>"Industri / Manufaktur",
                                "Pertambangan"=>"Pertambangan",
                                "Konsultan"=>"Konsultan",
                                "Hiburan"=>"Hiburan",
                                "Kesehatan"=>"Kesehatan",
                                "Keuangan"=>"Keuangan",
                                "Lingkungan Hidup"=>"Lingkungan Hidup",
                                "Pertanian"=>"Pertanian",
                                "Perikanan"=>"Perikanan",
                                "Ritel" => "Ritel",
                                "Teknologi Informasi"=>"Teknologi Informasi",
                                "Lainnya"=>"Lainnya",
                                ] as $bidang_pekerjaan => $bidang_pekerjaanLabel)
                                <option value="{{ $bidang_pekerjaan }}">{{ $bidang_pekerjaanLabel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="posisi" class="form-label">Posisi Pekerjaan</label>
                            <input type="text" name="posisi" id="posisi" class="form-control" placeholder="Misal: Manajer Property">
                        </div>
                        {{-- <div class="col-md-6">
                            <label for="subposisi" class="form-label">Sebagai</label>
                            <select name="subposisi[]" id="subposisi" class="form-control">
                                <option value="">Pilih</option>
                            </select>
                        </div> --}}
                    </div>

                    <div class="row mt-3 mb-5">
                        <div class="col-md-6">
                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan / Instansi</label>
                            <textarea class="form-control" name="nama_perusahaan" id="nama_perusahaan" rows="3">
                                
                            </textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="lokasi_perusahaan" class="form-label">Alamat Perusahaan / Instansi</label>
                            <textarea class="form-control" name="lokasi_perusahaan" id="lokasi_perusahaan" rows="3">
                                
                            </textarea>
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