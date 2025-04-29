<div class="modal modal-lg fade" id="post-form" tabindex="-1" aria-labelledby="post-form" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post" enctype="multipart/form-data" id="create_post">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 post-profile-title"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3 px-2 py-2">
                        <textarea id="post-content" name="post_content" class="form-control rounded shadow-sm" rows="3" placeholder="Tuliskan apa yang akan anda bagikan!" required></textarea>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="input-group mb-3 px-2 py-2 rounded-pill">
                        <input id="upload_image" type="file" name="post_image" onchange="readURL(this);" class="form-control border-1">
                        <div class="input-group-append">
                            <label for="upload" class="btn m-0 rounded-pill px-4"> <i class="bi bi-image"></i> <small class="text-uppercase font-weight-bold">Upload image</small></label>
                        </div>
                    </div>

                    <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="store">Posting</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>

    // $('body').on('click', '#btn-create-post', function(){
    //     $('#post-form').modal('show');
    // })

    // // submit postingan
    // $('#store').click(function(e){
    //     e.preventDefault();
    //     let formData = new FormData(this);

    //     $.ajax({
    //         url: '/post-create',
    //         type: 'POST',
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         success: function(response){
    //             Swal.fire({
    //                 type: 'success',
    //                 icon: 'success',
    //                 title: `${response.message}`,
    //                 showConfirmButton: false,
    //                 timer: 1500
    //             });

    //             // reload page after successful
    //             setTimeout(() => {
    //                 location.reload();
    //             }, 1500);
    //         },

    //         error: function(error){

    //         }
    //     })
    // })

    // // upload image
    // $('#upload_image').on('change', function(){
    //     $('#create_post').submit();
    // })
</script>