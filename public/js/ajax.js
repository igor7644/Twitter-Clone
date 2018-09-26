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
                    <div class="userAndComment">
                        <p><a href="user/${value['user']['id']}" data-id="${value['id']}" class="usernameComment">${value['user']['username']}</a> <span>${value['comment']}</span></p>
                    </div>
                    <a href="" class="replyLink" data-id="${value['id']}" data-postId="${value['post']['id']}">Reply</a>
                
                    <div class="replyDiv" id="reply-${value['id']}">
                        <form action="" method="POST" class="row">
                            <input type="hidden" name="${value['id']}">
                            <div class="form-group comment-border-focus col-md-9">
                            <textarea class="comment-${value['id']} form-control textarea-reply" cols="20" rows="1" placeholder="Reply.." maxlength="250"></textarea>
                            </div>
                            <div class="hiddenContent2 col-md-3 ml-auto">
                                <button type="submit" class="btn replyBtn">Reply</button>
                            </div>
                        </form>
                    </div>
                    `;
                    $.each(value['replies'], function(key, val){
                        text+=`
                            <p class="replyComment"><a href="user/${value['user']['id']}" data-id="${value['id']}" class="usernameComment">${val['user']['username']}</a> <span class="comment">${val['comment']}</span></p>
                        `;
                    });
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
                var childCom = 0;
                var parentCom = data.length;
                $.each(data, function(index, value){
                    childCom += value['replies'].length;
                });
                var sum = childCom + parentCom;
                
                $.each(data, function(index, value){
                    text += `
                    <div class="userAndComment">
                        <p><a href="user/${value['user']['id']}" data-id="${value['id']}" class="usernameComment">${value['user']['username']}</a> <span>${value['comment']}</span></p>
                    </div>
                    <a href="" class="replyLink" data-id="${value['id']}" data-postId="${value['post']['id']}">Reply</a>

                    <div class="replyDiv" id="reply-${value['id']}">
                        <form action="" method="POST" class="row">
                            <input type="hidden" id="postid" value="${value['id']}" name="${value['id']}">
                            <div class="form-group comment-border-focus col-md-9">
                            <textarea class="comment-${value['id']} form-control textarea-reply" cols="20" rows="1" placeholder="Reply.." maxlength="250"></textarea>
                            </div>
                            <div class="hiddenContent2 col-md-3 ml-auto">
                                <button type="submit" class="btn replyBtn">Reply</button>
                            </div>
                        </form>
                    </div>
                    `;
                    $.each(value['replies'], function(key, val){
                        text+=`
                            <p class="replyComment"><a href="" data-id="${val['id']}" class="usernameComment">${val['user']['username']}</a> <span class="comment">${val['comment']}</span></p>
                        `;
                    });
                });
                var number = ` <i class="far fa-comment-alt"> &nbsp;${sum}</i>`;
                
                $('.numOfComments-'+id).html(number);
                $('#comments-'+id).html(text);
                $('.comment-'+id).val('');
            }
        });
    });

    //insert reply
    $('.posts').on('click', '.replyLink', function(e){
        e.preventDefault();

        $('*[id^="reply-"]').hide();
        var commentId = $(this).attr('data-id');
        $('#reply-'+commentId).fadeIn();
        $('.textarea-reply').focus();

        var postId = $(this).attr('data-postId');
        
        $('.replyBtn').on('click', function(e){
            e.preventDefault();

            var reply = $('.comment-'+commentId).val();
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: baseUrl + '/comments/createReply',
                data: {
                    commentId,
                    postId,
                    reply
                },
                success: function(data){
                    $('.comment-'+commentId).val('');
                    $('*[id^="reply-"]').hide();
                    var text = '';
                    var childCom = 0;
                    var parentCom = data.length;
                    $.each(data, function(index, value){
                        childCom += value['replies'].length;
                    });
                    var sum = childCom + parentCom;

                    $.each(data, function(key, value){
                        text += `
                        <div class="userAndComment">
                            <p><a href="user/${value['user']['id']}" data-id="${value['id']}" class="usernameComment">${value['user']['username']}</a> <span>${value['comment']}</span></p>
                        </div>
                        <a href="" class="replyLink" data-id="${value['id']}" data-postId="${value['post']['id']}">Reply</a>
                        
                        <div class="replyDiv" id="reply-${value['id']}">
                        <form action="" method="POST" class="row">
                            <input type="hidden" id="postid" value="${value['id']}" name="${value['id']}">
                            <div class="form-group comment-border-focus col-md-9">
                            <textarea class="comment-${value['id']} form-control textarea-reply" cols="20" rows="1" placeholder="Reply.." maxlength="250"></textarea>
                            </div>
                            <div class="hiddenContent2 col-md-3 ml-auto">
                                <button type="submit" class="btn replyBtn">Reply</button>
                            </div>
                        </form>
                    </div>
                        `;
                        $.each(value['replies'], function(key, val){
                            text+=`
                                <p class="replyComment"><a href="user/${value['user']['id']}" data-id="${value['id']}" class="usernameComment">${val['user']['username']}</a> <span class="comment">${val['comment']}</span></p>
                            `;
                        });
                    });
                    var number = ` <i class="far fa-comment-alt"> &nbsp;${sum}</i>`;
                
                    $('.numOfComments-'+postId).html(number);
                    $('#comments-'+postId).html(text);
                }
            });

        });
      });

      //like
      $('.numberOf').on('click', '.like', function(){

        var postId = $(this).attr('data-id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: baseUrl + '/likes/create',
            data: {
                postId
            },
            success: function(data){
                var text = `<i class="fas fa-heart unlike" data-id="${postId}"> &nbsp;${data}</i> &nbsp; &nbsp;`;
                $('.numOfLikes-'+postId).html(text);
            }
        });
      });

      //unlike
      $('.numberOf').on('click', '.unlike', function(){

        var postId = $(this).attr('data-id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: baseUrl + '/likes/destroy',
            data: {
                postId
            },
            success: function(data){
                var text = `<i class="far fa-heart like" data-id="${postId}"> &nbsp;${data}</i> &nbsp; &nbsp;`;
                $('.numOfLikes-'+postId).html(text);
            }
        });
      });

      


});