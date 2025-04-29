<div class="modal modal-lg fade" id="comment-form" tabindex="-1" aria-labelledby="comment-form" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 post-profile-title">Tinggalkan Komentar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="post_comment_id" name="post_comment_id" value="{{ $p->id }}">

                    <div class="card feeds-card">
                        <div class="card-header modal-header-cap">
                            <div class="feed-header-modal"></div>
                            <p class="post_user_name"></p>
                            <p><small class="text-body-secondary post_date"></small></p>
                        </div>
                        <div class="card-body feed-body">
                            <p id="post_content" style="padding: 10px 0;"></p>
                            <div class="show-img">

                            </div>
                            {{-- <img src="" alt="" class="card-img-bottom img-card" id="post_img"> --}}
                        </div>
                    </div>
                    
                    <div id="show_comment"></div>
                    

                    <div class="input-group mb-3 px-2 py-2">
                        <textarea id="comment-content" name="komentar" class="form-control rounded shadow-sm" rows="3" placeholder="Leave a comment..." required></textarea>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="comment-btn">Komen</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
    $('body').on('click', '#btn-comment-post', function(){

        let post_id = $(this).data('id');

        $.ajax({
            url: `/alumnift/post/${post_id}`,
            type: 'GET',
            cache: false,
            success: function(response){
                console.log(response);
                $('.feed-header-modal').html('<img src="/user/foto/' + response.data.users.foto + '" class="float-start rounded" style="width: 65px; height: 65px; margin-right: 15px;">');
                $('.post_user_name').text(response.data.users.nama);
                $('.post_date').text(response.data.created_at);
                $('#post_content').text(response.data.deskripsi);
                $('.show-img').html('<img src="/alumni/postingan/' + response.data.media + '" class="card-img-bottom img-card">');
                
                var result = "";

                $.each(response.comments, function(index, value){
                    result = '<div class="d-flex text-body-secondary pt-4">' + 
                                '<img src="/user/foto/' + value.user_comment_post.foto + '" class="float-start rounded-circle" style="width: 50px; height: 50px; margin-right: 20px;">' +
                                '<p class="pb-3 mb-0 small lh-sm border-bottom">' +
                                    '<strong class="d-block text-gray-dark">' + value.user_comment_post.nama + '</strong>'
                                    + value.komentar + 
                                '</p>' +
                             '</div>';
                    $('#show_comment').append(result);
                    // $('#comments-user-img').append('<img src="/user/foto/' + value.user_comment_post.foto + '" class="float-start">');
                    // $('#comments-post').append('<div class="alert alert-secondary" role="alert">' + value.komentar + '</div>');
                })

                $('#comment-form').modal('show');
            }
        })

        $('#comment-btn').click(function(e) {
            e.preventDefault();

            let comment = $('#comment-content').val();
            let token = $("meta[name='csrf-token']").attr('content');

            $.ajax({
                url: 'post/' + post_id + '/comment-post',
                type: 'POST',
                data: {
                    _token: token,
                    komentar: comment
                },
                success: function(response) {
                    
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    // reload page after successful
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);

                    $('#comment-form').modal('hide');
                }
            })
        })
        
    })

    
</script>