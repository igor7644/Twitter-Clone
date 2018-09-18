const baseUrl = 'http://localhost/Laravel/SocialBlog/public';
$(document).ready(function(){

    //show cooments
    $('.showPost').on('click', function(e){
        e.preventDefault();

        var id = $(this).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'GET',
            url: baseUrl + '/comments',
            data: {
                id
            },
            success: function(data){
                var text = '';

                $.each(data, function(index, value){
                    text += `
                        <p><a href="" data-id="${value['id']}" class="usernameComment">${value['user']['username']}</a> <span class="comment">${value['comment']}</span></p>
                        <a href="" data-id="${value['id']}" class="replyLink">Reply</a>

                        <div class="replyDiv" id="reply-${value['id']}">
                            <form action="" method="POST" class="row">
                                <input type="hidden" name="${value['id']}">
                                <div class="form-group comment-border-focus col-md-9">
                                <textarea data-id="" class="comment-${value['id']} form-control textarea-reply comment-${value['id']}" cols="20" rows="1" placeholder="Reply.." maxlength="250"></textarea>
                                </div>
                                <div class="hiddenContent2 col-md-3 ml-auto">
                                    <button type="submit" class="btn replyBtn commentBtn">Reply</button>
                                </div>
                            </form>
                        </div>
                    `;
                });
                $('#comments-'+id).html(text);
            }
        });
    });

    //insert comment
    $('.posts').on('click', '.commentBtn', function(e){
        e.preventDefault();

        var id = $(this).attr('id');
        var comment = $('.comment-'+id).val();
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: baseUrl + '/comments/create',
            data: {
                id,
                comment
            },
            success: function(data){
                var text = '';
                var number = '';
                
                $.each(data, function(index, value){
                    text += `
                    <p><a href="" data-id="${value['id']}" class="usernameComment">${value['user']['username']}</a> <span class="comment">${value['comment']}</span></p>
                    <a href="" data-id="${value['id']}" class="replyLink">Reply</a>

                    <div class="replyDiv" id="reply-${value['id']}">
                        <form action="" method="POST" class="row">
                            <input type="hidden" name="${value['id']}">
                            <div class="form-group comment-border-focus col-md-9">
                            <textarea data-id="" class="comment-${value['id']} form-control textarea-reply comment-${value['id']}" cols="20" rows="1" placeholder="Reply.." maxlength="250"></textarea>
                            </div>
                            <div class="hiddenContent2 col-md-3 ml-auto">
                                <button type="submit" class="btn replyBtn commentBtn">Reply</button>
                            </div>
                        </form>
                    </div>
                    `;
                });
                number += ` <i class="far fa-comment-alt"> &nbsp;${data.length}</i>`;
                
                $('.numOfComments-'+id).html(number);
                $('#comments-'+id).html(text);
                $('.comment-'+id).val('');
            }
        });
    });

    //insert reply
    // $('#thread').on('click', 'replyBtn', function(e){
    //     e.preventDefault();

    //     var id = $(this).attr('id');
    //     alert(id);
    // });


});