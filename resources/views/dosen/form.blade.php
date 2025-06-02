<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-tag"></i></span>
                            <input type="text" name="nik" id="nik" class="form-control form-control-lg" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-user"></i></span>
                            <input type="text" name="nama" id="nama" class="form-control form-control-lg" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="program_studi"><strong>Program Studi</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-screen-desktop"></i></span>
                            <select name="program_studi" id="program_studi" class="form-select form-control" id="largeSelect" >
                                <option value="">Select</option>
                                @foreach ([
                                    "Teknik Pertambangan"=>"Teknik Pertambangan",
                                    "Teknik Industri"=>"Teknik Industri",
                                    "Perencanaan Wilayah dan Kota"=>"Perencanaan Wilayah dan Kota",
                                    "Program Profesi Insinyur"=>"Program Profesi Insinyur",
                                    "Magister Perencanaan Wilayah dan Kota"=>"Magister Perencanaan Wilayah dan Kota"
                                    ] as $prodi => $prodiLabel)
                                    <option value="{{ $prodi }}">{{ $prodiLabel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email"><strong>Email</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-envelope"></i></span>
                            <input type="email" name="email" id="email" required class="form-control" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1"/>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telepon"><strong>Telepon</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-screen-smartphone"></i></span>
                            <input type="telepon" name="telepon" id="telepon" required class="form-control" placeholder="Telepon" aria-label="Username" aria-describedby="basic-addon1"/>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-flat btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-flat btn-warning" data-bs-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>